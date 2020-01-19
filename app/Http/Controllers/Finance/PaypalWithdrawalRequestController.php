<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\BaseController;
use App\Http\Resources\PaypalWithdrawalRequestsResource;
use App\PaypalWithdrawalRequest;
use Illuminate\Http\Request;

class PaypalWithdrawalRequestController extends BaseController
{
    public function __construct($model = PaypalWithdrawalRequest::class, $resource = PaypalWithdrawalRequestsResource::class)
    {
        parent::__construct($model, $resource);
    }

    /**
     * @SWG\Get(
     *   path="/gateway/paypal/withdrawal-requests",
     *   tags={"Paypal withdrawal requests"},
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

}
