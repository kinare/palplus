<?php

namespace App\Http\Controllers\Finance;

use App\Account;
use App\AccountType;
use App\GatewaySetup;
use App\GatewayTransaction;
use App\Http\Controllers\BaseController;
use App\Http\Resources\TransactionResource;
use App\Http\Controllers\Currency\Converter;
use App\Http\Controllers\Gateway\GatewayTransactionController;
use App\Lib\Paypal\Checkout;
use App\Lib\Paypal\Payout;
use App\Lib\Paypal\Status;
use App\Lib\Rave\Account as BankAccount;
use App\Lib\Rave\Card;
use App\Lib\Rave\Mobile;
use App\Lib\Rave\Transfer;
use App\Transaction;
use App\Wallet;
use Illuminate\Http\Request;

class TransactionController extends BaseController
{
    use HasTransction;

    public function __construct($model = Transaction::class, $resource = TransactionResource::class)
    {
        parent::__construct($model, $resource);
    }

    /**
     * @SWG\Post(
     *   path="/transaction/wallet/deposit",
     *   tags={"Transactions"},
     *   summary="Deposit to a Wallet",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="amount",in="query",description="amount",required=true,type="number"),
     *   @SWG\Parameter(name="account_id",in="query",description="account id",required=true,type="integer"),
     *   @SWG\Parameter(name="cvv",in="query",description="cvv",required=false,type="string"),
     *   @SWG\Parameter(name="expirymonth",in="query",description="expirymonth",required=false,type="string"),
     *   @SWG\Parameter(name="expiryyear",in="query",description="expiryyear",required=false,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function deposit(Request $request){
        $request->validate([
            'amount' => 'required',
            'account_id' => 'required',
        ]);

        //get payment account
        $account = Account::find($request->account_id);

        //if account not set
        if (!$account)
            return $this->empty('Please add your '.mb_strtolower($request->gateway).' in account settings to proceed');

        $type = AccountType::find($account->account_type_id);

        switch ($type->type){
            case 'CARD' : //done
                $transaction = GatewayTransaction::initCard($account, $request->amount, $request->ip());
				$card = new Card();
                return $card->transact($transaction, [
                    'cvv' => $request->cvv,
                    'expirymonth' => $request->expirymonth,
                    'expiryyear' => $request->expiryyear,
                ]);

            case 'BANK ACCOUNT' : //done
                $account->payment_type = 'account';
                $account->accountbank = '232';
                $transaction = GatewayTransaction::initAccount($account, $request->amount, $request->ip());
                $bank = new BankAccount();
                return $bank->transact($transaction);

            case 'MOBILE MONEY' :// done
                $account->payment_type = 'mpesa';
                $account->narration = 'Wallet deposit';
				$account->is_mpesa = '1';
                $account->is_mpesa_lipa = '1';
                $transaction = GatewayTransaction::initMobile($account, $request->amount, $request->ip());
				$mobile = new Mobile();
                return $mobile->transact($transaction);

            case 'PAYPAL' : // done
                $transaction = GatewayTransaction::initPaypal($account, $request->amount);
                $pp = new Checkout();
                return $pp->transact($transaction);
        }
    }

    /**
     * @SWG\Post(
     *   path="/transaction/wallet/withdraw",
     *   tags={"Transactions"},
     *   summary="Withdraw from a Wallet",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="amount",in="query",description="amount",required=true,type="number"),
     *   @SWG\Parameter(name="account_id",in="query",description="account id",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function withdraw(Request $request){
        $request->validate([
            'amount' => 'required',
            'account_id' => 'required',
        ]);

        //get payment account and wallet
        $account = Account::find($request->account_id);
		$wallet  = Wallet::mine();

        //if account not set
        if (!$account) return response()->json([
            'message' => 'Please add your account in account settings to proceed'
        ], 500);

		$type = AccountType::find($account->account_type_id);
		if($type->type == 'CARD'){
			return response()->json([
				'message' => 'Please withdraw with either Bank, mobile or Paypal account.'
			], 401);
		}

		$checkAmount  =(float) $this->withdrawCheckAmount($wallet->currencyShortDesc(), 1)['data']['amount'];
		//check if the user has money if his wallet

		
		// find the withdraw fee rate setup ->rate %
		$withdrawSetup = \App\GatewaySetup::where('type', 'WITHDRAWAL')->first();
		// Wallet balance 
		$walletBalance  = (float)$wallet->total_balance;
		// amount withdrawal
		$amountWithdraw = (float)$request->amount;
		$transactionFee = (float)($amountWithdraw *($withdrawSetup->rate /100));
		
		
		if(!$walletBalance > ($amountWithdraw + $transactionFee)){
			return response()->json([
				'message' => '3. Insufficient fund. You wallet balance should be more than '.$wallet->currencyShortDesc() .' ' .($amountWithdraw +$checkAmount + $transactionFee) . ' Top up to continue.'
			], 401);
		}

		if(!((float)$wallet->total_balance > $checkAmount)){
			return response()->json([
				'message' => 'Insufficient fund. You wallet balance should be more than '.$wallet->currencyShortDesc() .' ' .($amountWithdraw + $checkAmount + $transactionFee) . ' Top up to continue.'
			], 401);
		}
		dd($walletBalance > ($amountWithdraw + $transactionFee));
		// if all passess this steps  continue to withdraw  am deduct the user with transaction fee;
		$appWallet  = Wallet::app();
        switch ($type->type){
			case 'BANK ACCOUNT' :
				//deduct fee from user wallet 
				$wallet->total_balance = (float)$wallet->total_balance - (float)$transactionFee;
				$wallet->total_balance = (float)$wallet->total_withdrawals + (float)$transactionFee;
				$wallet->save();

                $transaction = GatewayTransaction::bankTransfer($account, $request->amount);
                $transfer = new Transfer();
                return $transfer->send($transaction);
			case 'MOBILE MONEY' :
				$wallet->total_balance = (float)$wallet->total_balance - (float)$transactionFee;
				$wallet->total_balance = (float)$wallet->total_withdrawals + (float)$transactionFee;
				$wallet->save();

                $transaction = GatewayTransaction::mobileTransfer($account, $request->amount);
				dd($transaction);
				$transfer = new Transfer();
				return $transfer->send($transaction);
				return '';
			case 'PAYPAL' :
				$wallet->total_balance = (float)$wallet->total_balance - (float)$transactionFee;
				$wallet->total_balance = (float)$wallet->total_withdrawals + (float)$transactionFee;
				$wallet->save();

                $transaction = GatewayTransaction::initPaypalPayout($account, $request->amount);
                $pp = new Payout();
                return $pp->transact($transaction);
        }
	}


    public function payOut(Request $request){

        return $request;
        /* todo implement payout to */
    }

    /**
     * @SWG\Post(
     *   path="/transaction/card/pin",
     *   tags={"Transactions"},
     *   summary="Set card pin",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="pin",in="query",description="pin",required=true,type="string"),
     *   @SWG\Parameter(name="ref",in="query",description="ref",required=true,type="string"),
     *   @SWG\Parameter(name="cvv",in="query",description="cvv",required=false,type="string"),
     *   @SWG\Parameter(name="expirymonth",in="query",description="expirymonth",required=false,type="string"),
     *   @SWG\Parameter(name="expiryyear",in="query",description="expiryyear",required=false,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function setCardPin(Request $request){
        $request->validate([
            'pin' => 'required',
            'ref' => 'required'
        ]);

        $card = new Card();
        return $card->setPin($request->all());
    }

    /**
     * @SWG\Post(
     *   path="/transaction/card/otp",
     *   tags={"Transactions"},
     *   summary="Set card otp",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="otp",in="query",description="otp",required=true,type="string"),
     *   @SWG\Parameter(name="ref",in="query",description="ref",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function otp(Request $request){
        $request->validate([
            'otp' => 'required',
            'ref' => 'required'
        ]);

        $card = new Card();
        return $card->otp($request->all());
    }

    public function paypalToken(Request $request){
        $pp = new Status();
        return $pp->getPaymentStatus($request->all());
    }

    /**
     * @SWG\Post(
     *   path="/transaction/wallet/request",
     *   tags={"Transactions"},
     *   summary="Transaction request",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="amount",in="query",description="amount",required=true,type="number"),
     *   @SWG\Parameter(name="account_id",in="query",description="Account ID",required=true,type="integer"),
     *   @SWG\Parameter(name="type",in="query",description="Transaction Type(WITHDRAWAL/DEPOSIT)",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    public function transactionRequest(Request $request){

        $request->validate([
            'amount' => 'required',
            'account_id' => 'required',
            'type' => 'required'
        ]);

        $account = Account::find($request->account_id);
        $type = AccountType::find($account->account_type_id);
        $fee = 0;

        if ($type->type === 'CARD' || $type->type === 'BANK ACCOUNT' || $type->type === 'MOBILE MONEY'){
            $fee = (float)GatewayTransactionController::addTransactionFee('RAVE', $request->type, $request->amount) - (float)$request->amount;
        }

        return response()->json([
            'message' => 'You are about to make a '.mb_strtolower($request->type).' of '.Wallet::mine()->currencyShortDesc().' '. $request->amount.'. Transaction fee '.Wallet::mine()->currencyShortDesc().' '.$fee
        ], 200);
	}

	public function withdrawCheckAmount ($currency, $amount){
        $amount = Converter::Convert('USD', $currency, $amount);
        return [
            'data' => [
                'amount' => $amount['amount'],
                'type' => "Convert amount"
            ]
        ];
	}
	
}
