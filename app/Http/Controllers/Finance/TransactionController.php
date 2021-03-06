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
use App\UserSetup;
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
                    'cvv' => $account->cvv,
                    'expirymonth' => $account->expirymonth,
                    'expiryyear' => $account->expiryyear,
                ]);

            case 'BANK ACCOUNT' : //done
                $account->payment_type = 'account';
                // $account->accountbank = '232';
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
		]);
		if($request->user()->status  != 'active'){
			return response()->json([
				'message' => 'Your account has been suspended please contact admin on support@yunited.app'
			], 400);
		}

		$type = AccountType::find($account->account_type_id);
		if($type->type == 'CARD'){
			return response()->json([
				'message' => 'Please withdraw with either Bank, mobile or Paypal account.'
			]);
		}
		$ceilingAmount  =(float) $this->withdrawCheckAmount($wallet->currencyShortDesc(), 1)['data']['amount'];
		//check if the user has money if his wallet

		// find the withdraw fee rate setup ->rate %
		$withdrawSetup = \App\GatewaySetup::where('type', 'WITHDRAWAL')->where('active', true)->first();	
		if(!$withdrawSetup){
			return response()->json([
				'message' => 'Oooop! We apologize for the inconvenience caused. We are working to bring the service up'
			], 400);
		}
		
		$walletBalance  = (float)$wallet->total_balance;

		$amountWithdraw = (float)$request->amount;


		$minimumWithdrawalAmount  =(float) $this->withdrawCheckAmount($wallet->currencyShortDesc(), (float)$withdrawSetup->min_amount)['data']['amount'];
		$minimumWalletBalanceAmount  =(float) $this->withdrawCheckAmount($wallet->currencyShortDesc(), (float)2)['data']['amount'];
		$maximumWithdrawalAmount  =(float) $this->withdrawCheckAmount($wallet->currencyShortDesc(), $withdrawSetup->max_amount)['data']['amount'];
		$maximumWithdrawalLimitPerday  =(float) $this->withdrawCheckAmount($wallet->currencyShortDesc(),$withdrawSetup->limit_per_day)['data']['amount'];
		$transactionFees = $this->getTransactionFees($amountWithdraw, $wallet);
		
		
		// Total Deduction = AmountWithdrawn  + transactionFees
		$total_deduction_amount = $amountWithdraw + $transactionFees;
		// Not more that the withdrawable amount
		if($amountWithdraw > $maximumWithdrawalAmount){
			return response()->json([
				'message' => 'Failed, You cannot withdraw amount more than  '. $wallet->currencyShortDesc() .' ' . (float)$maximumWithdrawalAmount . ' per transaction'
			], 400);
		}
		

		// conditions
		if($minimumWithdrawalAmount > $amountWithdraw){
			return response()->json([
				'message' => 'Failed, Your balance is below the minimum withdrable amount of '. $wallet->currencyShortDesc() .' ' . $minimumWithdrawalAmount
			], 400);
		}
		// 0. Check that the wallet amount is greater than the  amount being withdrawn
		if(!((float)$wallet->total_balance > $amountWithdraw)){
			return response()->json([
				'message' => 'Insufficient fund. Top up to continue'
			],400);
		}
	
		//1. Check that the wallet amount is greater than the  amount being withdrawn
		if(((float)$amountWithdraw < $minimumWithdrawalAmount)){
			return response()->json([
				'message' => 'Failed, The minimum withdrawable amount should not be below '. $wallet->currencyShortDesc() .' ' . $minimumWithdrawalAmount
			], 400);
		}	

		//2. Ensure that Wallet Amount is more than the balance 
		if(!((float)$wallet->total_balance > $total_deduction_amount)){
			return response()->json([
				'message' => 'Insufficient Funds, Your account balance is below '. $wallet->currencyShortDesc() .' ' . $total_deduction_amount
			], 400);
		}

		// 3. Check that the wallet amount is greater than $2 -> 200;
		if(((float)$wallet->total_balance < $minimumWalletBalanceAmount)){
			return response()->json([
				'message' => 'You wallet balance should more than '. $wallet->currencyShortDesc() .' ' . $minimumWithdrawalAmount
			], 400);
		}


		//4 Check what will be the balance after withdrawing the amount  show be 
		// equal or greater than $minimumWithdrawalAmount

		// if(!((float)$wallet->total_balance - $total_deduction_amount >= $minimumWithdrawalAmount)){
		// 	return response()->json([
		// 		'message' => 'You wallet balance  after withdrawing should  be equal to or more than '. $wallet->currencyShortDesc() .' ' . $minimumWithdrawalAmount
		// 	], 400);
		// }

		/**
		 * User Setup 
		 */
		$user_setup_allow_withdrawal = UserSetup::allowWithdraw($request->user()->id, $amountWithdraw);

		$user_setup = UserSetup::setup($request->user()->id, $amountWithdraw, $maximumWithdrawalLimitPerday);
		
		$today_user_setup = UserSetup::
							whereDate('created_at', '=', date('Y-m-d'))
							->where('user_id', $request->user()->id)->first();

	
		if(!$user_setup_allow_withdrawal) {
			return response()->json([
				'message' => 'Failed, You have reached maximum withdrawal amount for today of '. $wallet->currencyShortDesc() .' ' . $maximumWithdrawalLimitPerday . ' Your balance to withdrawal is '.  $wallet->currencyShortDesc(). " ". ($maximumWithdrawalLimitPerday - (float)$today_user_setup->balance_to_withdrawal)
			], 400);
		}
		// dd($maximumWithdrawalLimitPerday);
		if(!$today_user_setup){
			return response()->json([
				'message' => 'Failed, Please try again!! '
			], 400);
		}
		// if($user_setup->balance_to_withdrawal == null){
		// 	return response()->json([
		// 		'message' => 'Failed, Please try again!! '
		// 	], 400);
		// }
		// Check the amount to limit per day

		if(!((float)$today_user_setup->balance_to_withdrawal < (float)$maximumWithdrawalLimitPerday)){
			return response()->json([
				'message' => 'Failed, You have reached your daily maxmium withdrawal amount of ' . $wallet->currencyShortDesc() .' ' . $maximumWithdrawalLimitPerday
			], 400);
		}

		// if all passess this steps  continue to withdraw  am deduct the user with transaction fee;
		$appWallet  = Wallet::app();


        /// to Be Removed

        $wallet->total_balance = (float)$wallet->total_balance - (float)$transactionFees  - (float)$request->amount;
        $wallet->total_withdrawals = (float)$wallet->total_withdrawals + (float)$transactionFees + (float)$request->amount;
        $wallet->save();

        // end of to be removed


        // // Save to  App wallet
        $appWallet->total_balance = (float)$appWallet->total_balance + (float)$transactionFees;
        $appWallet->total_deposits = (float)$appWallet->total_deposits + (float)$transactionFees;
        $appWallet->save();
        switch ($type->type){
			case 'BANK ACCOUNT' :
                $transaction = GatewayTransaction::bankTransfer($account, $request->amount, (float)$transactionFees);
                $transfer = new Transfer();
                return $transfer->send($transaction);
			case 'MOBILE MONEY' :
                $transaction = GatewayTransaction::mobileTransfer($account, $request->amount, (float)$transactionFees);
				$transfer = new Transfer();
				return $transfer->send($transaction);

			case 'PAYPAL' :
                $transaction = GatewayTransaction::initPaypalPayout($account, $request->amount, (float)$transactionFees);
                $pp = new Payout();
                return $pp->transact($transaction);
		}
		
		
		// return response()->json([
		// 	'message' => 'Oooop! We apologize for the inconvenience caused. We are working to bring the service up'
		// ], 400);

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
            // $raveAmount = (float)GatewayTransactionController::addTransactionFee('RAVE', $request->type, $request->amount) - (float)$request->amount;
            $fee = (float)0;
            if($request->type == "WITHDRAWAL"){
                $fee = $this->getTransactionFees((float)$request->amount, Wallet::mine());
            }


            

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


    public function getTransactionFees($amount,$wallet){
        $transactionFees = "";

        $ceilingAmount  =(float) $this->withdrawCheckAmount($wallet->currencyShortDesc(), 1)['data']['amount'];
		// $withdrawSetup = \App\GatewaySetup::where('type', 'WITHDRAWAL')->where('active', true)->first();	
		$defaultTransactionFees  = (ceil($ceilingAmount/1000)*100)*1;
		      
		$transactionRateFees = (float)((float)$amount *((float)9 /100));

        if($transactionRateFees > $defaultTransactionFees ){
            $transactionFees = $transactionRateFees;
        }else{
            $transactionFees = $defaultTransactionFees;
        }

        return $transactionFees;
    }
	
}
