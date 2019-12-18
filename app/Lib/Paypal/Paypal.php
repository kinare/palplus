<?php


namespace App\Lib\Paypal;
use Srmklive\PayPal\Facades\PayPal as PP;

class Paypal
{
    protected $provider;

    protected $data;

    public function __construct(String $provider)
    {
        $this->provider = PP::setProvider($provider);
    }
}
