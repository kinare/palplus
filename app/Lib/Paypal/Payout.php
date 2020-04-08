<?php

namespace App\Lib\Paypal;


use App\Account;
use App\GatewayTransaction;
use App\Http\Controllers\Finance\HasTransction;
use App\Http\Controllers\Finance\Transaction;
use App\Wallet;
use PayPal\Api\Currency;
use PayPal\Api\PayoutItem;
use PayPal\Api\PayoutSenderBatchHeader;

class Payout extends PayPal
{
    use HasTransction;

    public function transact(GatewayTransaction $gatewayTransaction){
        $data = json_decode($gatewayTransaction->payload);

        $payouts = new \PayPal\Api\Payout();

        $senderBatchHeader = new PayoutSenderBatchHeader();
        $senderBatchHeader->setSenderBatchId(uniqid())
            ->setEmailSubject($data->invoice->description);


        $senderItem = new PayoutItem();
        $senderItem->setRecipientType('Email')
            ->setNote($data->invoice->description)
            ->setReceiver($data->receiver->email)
            ->setSenderItemId($data->invoice->invoice_no)
            ->setAmount(new Currency('{"value":"'.$data->receiver->amount.'","currency":"'.env('PAYPAL_CURRENCY').'"}'));

        $payouts->setSenderBatchHeader($senderBatchHeader)
            ->addItem($senderItem);


        $request = clone $payouts;

        try {
            $output = $payouts->create(array('sync_mode' => 'false'), $this->_api_Context);

            if ($output->getBatchHeader()->getBatchStatus() === 'PENDING' || $output->getBatchHeader()->getBatchStatus() === 'SUCCESS'){

                /* perform transaction */
                $account = Account::find($gatewayTransaction->type);
                $account->currency = env('PAYPAL_CURRENCY');
                $wallet = Wallet::whereUserId($gatewayTransaction->user_id)->first();

                $transaction = new Transaction();
                $transaction->withdraw($account, $wallet, $data->receiver->amount, $data->receiver->email, $data->invoice->description);

                return $this->success('Withdrawal success');
            }else{
                return $this->error('Transaction failed');
            }
        }catch (\Exception $e){
            return $this->error('Some error occur, sorry for inconvenient');
        }
    }
}
