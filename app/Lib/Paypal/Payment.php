<?php

namespace App\Lib\Paypal;


use App\GatewayTransaction;
use App\Http\Controllers\Finance\HasTransction;
use App\PaypalWithdrawalRequest;

class Payment extends PayPal
{
    use HasTransction;
    public function __construct($provider = 'adaptive_payments')
    {
        parent::__construct($provider);

        $this->data['payer'] = 'EACHRECEIVER';
        $this->data['return_url'] = url('api/paypal/ec-checkout-success');
        $this->data['cancel_url'] = url('api/');
    }

    public function transact(GatewayTransaction $transaction){
        $data = json_decode($transaction->payload, true);
        return $this->pay($data);
    }

    public function pay($data){
        $res = $this->provider->createPayRequest($data);
        $url = $this->provider->getRedirectUrl('approved', $res['payKey']);

        /* save the withdrawal request to be approved by admin*/
        $req = PaypalWithdrawalRequest::make($url, $data['receivers']['amount']);

        if ($req)
            return $this->success('Withdrawal request received successfully and is being processed');

        return $this->error('Failed to process withdrawal request');
    }
}
