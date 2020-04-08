<?php


namespace App\Lib\Paypal;

use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class Paypal
{
    protected $provider;

    protected $data;

    public function __construct()
    {
        $paypal_conf = \Config::get('paypal');

        $this->_api_Context = new ApiContext( new OAuthTokenCredential( $paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_Context->setConfig($paypal_conf['settings']);
    }
}
