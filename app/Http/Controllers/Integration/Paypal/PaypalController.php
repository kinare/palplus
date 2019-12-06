<?php

namespace App\Http\Controllers\Integration\Paypal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Srmklive\PayPal\Facades\PayPal;
use Srmklive\PayPal\Services\AdaptivePayments;
use Srmklive\PayPal\Services\ExpressCheckout;

class PaypalController extends Controller
{
    protected $provider;

    protected $data;

    public function __construct(String $provider)
    {
        $this->provider = PayPal::setProvider($provider);
    }
}
