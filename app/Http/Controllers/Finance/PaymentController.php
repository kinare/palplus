<?php

namespace App\Http\Controllers\Finance;

use App\Contribution;
use App\ContributionType;
use App\Http\Controllers\BaseController;
use App\Http\Resources\PaymentResource;
use App\Loan;
use App\Members;
use App\Payment;
use App\Penalty;
use App\Wallet;
use Illuminate\Http\Request;

class PaymentController extends BaseController
{
    public function __construct($model = Payment::class, $resource = PaymentResource::class)
    {
        parent::__construct($model, $resource);
    }

    /**
     * @SWG\Get(
     *
     *   path="/payments",
     *   tags={"Payments"},
     *   summary="Retrieve all Payments",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Post(
     *   path="/payments/pay",
     *   tags={"Payments"},
     *   summary="Settle pending payments",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="payment_id",in="query",description="payment id",required=true,type="integer"),
     *   @SWG\Parameter(name="amount",in="query",description="amount",required=true,type="number"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function pay(Request $request){
        $request->validate([
            'payment_id' => 'required',
            'amount' => 'required'
        ]);

        $payment = Payment::find($request->payment_id);

        if ($payment->amount > $request->amount)
            return response()->json([
                'message' => 'Payment cleared'
            ], 403);

        //Get Wallet
        $wallet = Wallet::mine();

        //validate wallet
        if (!$wallet->canWithdraw($request->amount))
            return response()->json([
                'message' => 'Insufficient funds balance: '.$wallet->total_balance
            ], 403);

        //Get payment model
        $model = $payment->model::where('id', $payment->model_id)->first();
        if ($model instanceof Loan)
            $model = Loan::pay($model, $request->amount);

        if ($model instanceof ContributionType)
            $model = Contribution::contribute($model, Members::member($model->group_id), $request->amount);

        if ($model instanceof Penalty)
            $model = Penalty::pay($model, Members::find($model->member_id), $request->amount);

        $payment->amount = (float)$payment->amount - (float)$request->amount;
        if ($payment->amount <= 0) $payment->status = 'cleared';
        $payment->save();

        return response()->json([
            'message' => 'Payment Received successfully. Balance :'.$payment->amount
        ], 200);
    }

    // todo settle pending payments from contributions and loan repayment
}
