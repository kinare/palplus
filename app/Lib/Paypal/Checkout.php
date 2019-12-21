<?php


namespace App\Lib\Paypal;


use App\GatewayTransaction;
use Cache;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;

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

        $paypalCache = [];
        array_push($paypalCache, $this->data);
        Cache::set('paypal', $paypalCache, Carbon::now()->addHours(24));
        return [
            'url' => $res['paypal_link']
        ];
    }

    public function getCheckoutSuccess($token){
        $res = $this->provider->GetExpressCheckoutDetails($token);
        return $this->doCheckout($res);
    }

    public function doCheckout($checkout){
        $response = [];
        $datas = Cache::get('paypal');

        foreach ($datas as $data){
            $res = $this->provider->doExpressCheckoutPayment($data, $checkout['TOKEN'], $checkout['PAYERID']);
            array_push($response , $res);
        }

       return  $response;
    }
}
