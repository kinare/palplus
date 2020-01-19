<?php

namespace App\Http\Controllers\Finance;

use App\Account;
use App\AccountType;
use App\GatewayTransaction;
use App\Http\Controllers\BaseController;
use App\Http\Resources\TransactionResource;
use App\Lib\Paypal\Checkout;
use App\Lib\Paypal\Payment;
use App\Lib\Rave\Account as BankAccount;
use App\Lib\Rave\Card;
use App\Lib\Rave\Mobile;
use App\Transaction;
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
     *   @SWG\Parameter(name="gateway",in="query",description="gateway i.e CARD/ACCOUNT/MOBILE/PAYPAL",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function deposit(Request $request){
        $request->validate([
            'amount' => 'required',
            'gateway' => 'required',
        ]);

        //get payment account
        $account =  $account = Account::where([
            'user_id' => $request->user()->id,
            'account_type_id' => AccountType::type($request->gateway)->id
        ])->first();

        //if account not set
        if (!$account)
            return $this->empty('Please add your '.mb_strtolower($request->gateway).' in account settings to proceed');

        switch ($request->gateway){
            case 'CARD' : //
                $transaction = GatewayTransaction::initCard($account, $request->amount, $request->ip());
                $card = new Card();
                return $card->transact($transaction);

            case 'ACCOUNT' : //done
                $account->payment_type = 'account';
                $account->accountbank = '232';
                $transaction = GatewayTransaction::initAccount($account, $request->amount, $request->ip());
                $bank = new BankAccount();
                return $bank->transact($transaction);

            case 'MOBILE' :// done
                //todo implement for other mobile money options

                //set relevant account field
                $account->payment_type = 'mpesa';
                $account->narration = 'payment details';
                $account->is_mpesa = '1';
                $account->is_mpesa_lipa = '1';
                $transaction = GatewayTransaction::initMobile($account, $request->amount, $request->ip());
                $mobile = new Mobile();
                return $mobile->transact($transaction);

            case 'PAYPAL' : // done
                $transaction = GatewayTransaction::initPaypal($request->amount);
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
     *   @SWG\Parameter(name="gateway",in="query",description="gateway i.e CARD/ACCOUNT/MOBILE/PAYPAL",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function withdraw(Request $request){
        $request->validate([
            'amount' => 'required',
            'gateway' => 'required',
        ]);


        //get payment account
        $account =  $account = Account::where([
            'user_id' => $request->user()->id,
            'account_type_id' => AccountType::type($request->gateway)->id
        ])->first();

        //if account not set
        if (!$account) return response()->json([
            'message' => 'Please add your account in account settings to proceed'
        ], 500);

        switch ($request->gateway){
            case 'ACCOUNT' :
                /* implement bank transfer */
                return;
            case 'MOBILE' :
                /* implement mobile transfer */
                return;
            case 'PAYPAL' :
                $transaction = GatewayTransaction::initPaypalPayout($account, $request->amount);
                $pp = new Payment();
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
        $pp = new Checkout();
        return $pp->getCheckoutSuccess($request->token);
    }


}
