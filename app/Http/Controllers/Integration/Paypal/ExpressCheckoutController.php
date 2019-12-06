<?php

namespace App\Http\Controllers\Integration\Paypal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExpressCheckoutController extends PaypalController
{
    public function __construct(String $provider = 'express_checkout')
    {
        parent::__construct($provider);

        $this->data['return_url'] = url('/paypal/ec-checkout-success');
        $this->data['cancel_url'] = url('/');
    }

    public function setItems(array $items){
        $this->data['items'] = $items;
    }

    public function setInvoice(array $invoice){
        $this->data['invoice_id'] = $invoice['invoice_id'];
        $this->data['invoice_description'] = $invoice['description'];

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
        dump($request);
    }
}
