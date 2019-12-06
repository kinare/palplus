<?php

namespace App\Http\Controllers\Integration\Paypal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\AdaptivePayments;
use Srmklive\PayPal\Services\ExpressCheckout;

class PaypalController extends Controller
{
    protected $provider;

    public function __construct(String $provider)
    {
        $this->setProvider($provider);
    }

    public function setProvider($provider){
        if ($provider === '')
            $this->provider = new ExpressCheckout();

        if ($provider === '')
            $this->provider =  new AdaptivePayments();
    }
}
