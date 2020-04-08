<?php


namespace App\Lib\Paypal;

use App\Account;
use App\GatewayTransaction;
use App\Http\Controllers\Finance\HasTransction;
use App\Http\Controllers\Finance\Transaction;
use App\Wallet;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;


class Status extends Paypal
{

    use HasTransction;

    public function getPaymentStatus($status)
    {
        if (empty($status['PayerID']) || empty($status['token'])) {
            return $this->error('Payment failed');
        }

        $gatewayTransaction = GatewayTransaction::whereRef($status['paymentId'])->first();

        if (!$gatewayTransaction){
            return $this->error('Invalid transaction');
        }

        /** Get the payment ID before session clear **/
        $payment_id = $gatewayTransaction->ref;

        $payment = Payment::get($payment_id, $this->_api_Context);
        $execution = new PaymentExecution();
        $execution->setPayerId($status['PayerID']);

        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_Context);

        if ($result->getState() == 'approved') {

            $account = Account::find($gatewayTransaction->type);
            $account->currency = env('PAYPAL_CURRENCY');
            $wallet = Wallet::whereUserId($gatewayTransaction->user_id)->first();

            $data = json_decode($gatewayTransaction->payload);

            $transaction = new Transaction();
            $transaction->deposit($account, $wallet, $data->item->amount, $data->item->name, $data->invoice->description);

            return $this->success('Deposit success');
        }else{
            return $this->error('Transaction failed');
        }
    }
}
