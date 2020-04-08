<?php


namespace App\Lib\Paypal;

use App\GatewayTransaction;
use App\Http\Controllers\Finance\HasTransction;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Api\Payment;

class Checkout extends Paypal
{
    use HasTransction;

    public function transact(GatewayTransaction $gatewayTransaction)
    {
        $data = json_decode($gatewayTransaction->payload);

        /* set payment method */
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        /* set items */
        $item_1 = new Item();
        $item_1->setName($data->item->name)
            ->setCurrency($data->item->currency)
            ->setQuantity($data->item->qty)
            ->setPrice($data->item->amount);

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));


        /* set amount */
        $amount = new Amount();
        $amount->setCurrency($data->item->currency)
            ->setTotal($data->item->amount);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setInvoiceNumber($data->invoice->invoice_no)
            ->setDescription($data->invoice->description);

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(url('api/gateway/paypal/ec-checkout-success')) /** Specify return URL **/
        ->setCancelUrl( url('api/'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($this->_api_Context);
        } catch (PayPalConnectionException $ex) {

            if (\Config::get('app.debug')) {
                return $this->error('Connection timeout');
            } else {

                return $this->error('Some error occur, sorry for inconvenient');
            }

        }

        $redirect_url = '';

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        if (isset($redirect_url)){
            $gatewayTransaction->ref = $payment->getId();
            $gatewayTransaction->save();
            return $this->link($redirect_url);
        }else{
            return $this->error('Unknown error occurred');
        }
    }
}
