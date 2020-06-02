<?php

namespace App\Http\Controllers\Finance;

use App\Account;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Currency\Converter;
use App\Transaction as TransactionRecords;
use App\Wallet;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpParser\Node\Scalar\String_;

class Transaction extends Accounting
{

    protected $state;

    public function __construct()
    {
        $this->state = 0;
    }

    public function transact(Wallet $from, Wallet $to, $amount, String $type, String $description = null){

        /* Convert currency between wallets */
        $converted = (object)Converter::Convert($from->currencyShortDesc(), $to->currencyShortDesc(), $amount);

        /* Debit the from wallet */
        $debit = $this->debit($from, $amount);

        /* if debit success record transaction*/
        if ($debit){
            $this->record([
                'transaction_code' => 'PP-'.Carbon::now()->timestamp,
                'wallet_id' => $debit->id,
                'entry' => 'debit',
                'transaction_from' => $from->id,
                'transaction_to' => $to->id,
                'transaction_type' => 'internal',
                'account_no' => null,
                'type' => $type,
                'description' => $description,
                'amount' => $amount,
                'from_currency' => $from->currencyShortDesc(),
                'to_currency' => $to->currencyShortDesc(),
                'conversion_rate' => serialize($converted->rate),
				'conversion_time' => $converted->time,
				'status' => 'processed'
            ]);
            $this->state++;
        }

        /* Credit the to wallet */
        $credit = $this->credit($to, $converted->amount);


        /* Record transaction on successfull credit*/
        if ($credit){
            $this->record([
                'transaction_code' => 'PP-'.Carbon::now()->timestamp,
                'wallet_id' => $credit->id,
                'entry' => 'credit',
                'transaction_from' => $from->id,
                'transaction_to' => $to->id,
                'transaction_type' => 'internal',
                'account_no' => null,
                'type' => $type,
                'description' => $description,
                'amount' => $converted->amount,
                'from_currency' => $from->currencyShortDesc(),
                'to_currency' => $to->currencyShortDesc(),
                'conversion_rate' => serialize($converted->rate),
				'conversion_time' => $converted->time,
				'status' => 'processed'
            ]);
            $this->state++;
        }

        /* check the transaction status */
        if ($this->state >= 2)
            return true;

        return false;
    }

    public function withdraw(Account $account ,Wallet $wallet, $amount, $type = null, $description = null){

        /* Convert currency between wallets */
        $converted = (object)Converter::Convert($account->currency , $wallet->currencyShortDesc(), $amount);
        $this->state++;

        /* Credit the to wallet */
        $debit = $this->debit($wallet, $converted->amount);
        $this->state++;

        if ($debit)
            $this->record([
                'transaction_code' => 'PP-'.Carbon::now()->timestamp,
                'wallet_id' => $wallet->id,
                'entry' => 'debit',
                'transaction_from' => $wallet->id,
                'transaction_to' => $account->id,
                'transaction_type' => 'external',
                'account_no' => $account->number,
                'type' => $type,
                'description' => $description,
                'amount' => $converted->amount,
                'from_currency' => $account->currency,
                'to_currency' => $wallet->currencyShortDesc(),
                'conversion_rate' => serialize($converted->rate),
				'conversion_time' => $converted->time,
				'status' => 'processed'
            ]);

        /* check the transaction status */
        if ($this->state >= 2)
            return true;

        return false;
    }

    public function deposit(Account $account ,Wallet $wallet, $amount, $type = null, $description = null){
        /* Convert currency between wallets */
        $converted = (object)Converter::Convert($account->currency , $wallet->currencyShortDesc(), $amount);
        $this->state++;

        /* Credit the to wallet */
        $credit = $this->credit($wallet, $converted->amount);
        $this->state++;

        if ($credit)
        $this->record([
                'transaction_code' => 'PP-'.Carbon::now()->timestamp,
                'wallet_id' => $wallet->id,
                'entry' => 'credit',
                'transaction_from' => $account->id,
                'transaction_to' => $wallet->id,
                'transaction_type' => 'external',
                'account_no' => $account->number,
                'type' => $type,
                'description' => $description,
                'amount' => $converted->amount,
                'from_currency' => $account->currency,
                'to_currency' => $wallet->currencyShortDesc(),
                'conversion_rate' => serialize($converted->rate),
				'conversion_time' => $converted->time,
				'status' => 'processed'
            ]);

        /* check the transaction status */
        if ($this->state >= 2)
            return true;

        return false;
    }

    public function payout(Wallet $wallet, Account $account, $amount, $type = null, $description = null){
        /* TODO: implement payout */
    }

    protected function record($details){
        $transaction = new TransactionRecords();
        $transaction->fill($details);
        $transaction->created_by = Auth::id();
        $transaction->save();
        return $transaction;
    }
}
