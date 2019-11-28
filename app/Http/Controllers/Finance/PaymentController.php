<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\BaseController;
use App\Http\Resources\PaymentResource;
use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends BaseController
{
    public function __construct($model = Payment::class, $resource = PaymentResource::class)
    {
        parent::__construct($model, $resource);
    }

    /**
     * @SWG\Get(
     *   path="/payments",
     *   tags={"Payments"},
     *   summary="Retrieve Payments",
     *  security={
     *     {"bearer": {}},
     *   },
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



    }



}
