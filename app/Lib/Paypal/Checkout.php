<?php


namespace App\Lib\Paypal;


use App\GatewayTransaction;
use Illuminate\Http\Request;

class Checkout extends Paypal
{
    public function __construct($provider = 'express_checkout')
    {
        parent::__construct($provider);

        $this->data['return_url'] = url('api/paypal/ec-checkout-success');
        $this->data['cancel_url'] = url('api/');
    }

    public function transact(GatewayTransaction $transaction){
        $data = json_decode($transaction->payload, true);
        $this->setItems($data['item']);
        $this->setInvoice($data['invoice']);
        return $this->checkout();
    }

    public function setItems(array $items){
        $this->data['items'] = $items;
    }

    public function setInvoice(array $invoice){
        $this->data['invoice_id'] = $invoice['invoice_id'];
        $this->data['invoice_description'] = $invoice['invoice_description'];

        $total = 0;
        foreach ($this->data['items'] as $item) {
            $total += $item['price'] * $item['qty'];
        }
        $this->data['total'] = $total;
    }

    public function checkout(){
        $res = $this->provider->setExpressCheckout($this->data, false);
        return $res['paypal_link'];
    }

    public function getCheckoutSuccess(Request $request){
        return $request;
    }
}
