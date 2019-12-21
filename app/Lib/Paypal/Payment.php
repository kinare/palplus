<?php

namespace App\Lib\Paypal;


use App\GatewayTransaction;

class Payment extends PayPal
{
    public function __construct($provider = 'adaptive_payments')
    {
        parent::__construct($provider);

        $this->data['payer'] = 'EACHRECEIVER';
        $this->data['return_url'] = url('api/paypal/ec-checkout-success');
        $this->data['cancel_url'] = url('api/');
    }

    public function transact(GatewayTransaction $transaction){
        $data = json_decode($transaction->payload, true);
        return $this->checkout();
    }


    public function pay($data){
        $res = $this->provider->createPayRequest($data);
        $url = $this->provider->getRedirectUrl('approved', $res['payKey']);
        return $url;
    }
}
