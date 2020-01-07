<?php


namespace App\Lib\Paypal;


use App\Account;
use App\GatewayTransaction;
use App\Http\Controllers\Currency\Converter;
use App\Http\Controllers\Finance\HasTransction;
use App\Http\Controllers\Finance\Transaction;
use App\Wallet;
use Cache;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;

class Checkout extends Paypal
{
    use HasTransction;

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
        dump($this->data);
    }

    public function checkout(){
        $res = $this->provider->setExpressCheckout($this->data, false);

        if ($res['ACK'] === 'Failure')
            return $this->error($res['L_LONGMESSAGE0']);

        $paypalCache = [];
        $cache = $this->data;
        $cache['token'] = explode('=', $res['paypal_link']);
        $cache['token'] = array_pop($cache['token']);
        $cache['user_id'] = \Auth::user()->id;
        array_push($paypalCache, $cache);
        Cache::set('paypal', $paypalCache, Carbon::now()->addHours(24));
        return $this->link($res['paypal_link']);
    }

    public function getCheckoutSuccess($token){
        $res = $this->provider->GetExpressCheckoutDetails($token);
        return $this->doCheckout($res);
    }

    public function doCheckout($checkout){
        $response  = null;
        $datas = Cache::get('paypal');

        foreach ($datas as $key => $value){
            if ($value['token'] === $checkout['TOKEN'] ){
                $response = $this->provider->doExpressCheckoutPayment($value, $checkout['TOKEN'], $checkout['PAYERID']);

                if ($response['ACK'] === 'SuccessWithWarning')
                    return $this->error($response['L_SHORTMESSAGE0'].' : '.$response['L_LONGMESSAGE0']);

                if ($response['ACK'] === 'Success'){
                    $transaction = new Transaction();
                    $transaction->deposit(
                        Account::whereUserId($value['user_id'])->first(),
                        Wallet::whereUserId($value['user_id'])->first(),
                        $value['total'],
                        'DEPOSIT',
                        'Wallet deposit via paypal'
                    );
                    return $this->success($response['ACK']);
                }

                //unset transaction from cache
                unset($datas[$key]);
                Cache::set('paypal', $datas, Carbon::now()->addHours(24));
            }

        }

        if (!$response)
            return $this->error('Transaction not found');

       return  $response;
    }
}
