<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaypalWithdrawalRequestsResource;
use App\PaypalWithdrawalRequest;
use Illuminate\Http\Request;

class PaypalWithdrawalRequestController extends BaseController
{
    public function __construct($model = PaypalWithdrawalRequest::class, $resource = PaypalWithdrawalRequestsResource::class)
    {
        parent::__construct($model, $resource);
    }
}
