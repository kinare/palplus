<?php

namespace App\Http\Controllers\Finance;

use App\Account;
use App\AccountType;
use App\GatewayTransaction;
use App\Http\Controllers\BaseController;
use App\Http\Resources\TransactionResource;
use App\Lib\Rave\Card;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends BaseController
{
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
     *   @SWG\Parameter(name="gateway",in="query",description="gateway i.e CARD/MOBILE",required=true,type="string"),
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

        if ($request->gateway === 'CARD'){
            $account = Account::where([
                'user_id' => $request->user()->id,
                'account_type_id' => AccountType::type('CARD')->id
            ])->first();

            $transaction = GatewayTransaction::initCard($account, $request->amount, $request->ip());
            $card = new Card();
            return $card->transact($transaction);
        }

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
        return $card->validate($request->all());
    }


}
