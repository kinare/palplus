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
                'account_no' => null,
                'type' => $type,
                'description' => $description,
                'amount' => $amount,
                'from_currency' => $from->currencyShortDesc(),
                'to_currency' => $to->currencyShortDesc(),
                'conversion_rate' => $converted->rate,
                'conversion_time' => $converted->time,
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
                'account_no' => null,
                'type' => $type,
                'description' => $description,
                'amount' => $converted->amount,
                'from_currency' => $from->currencyShortDesc(),
                'to_currency' => $to->currencyShortDesc(),
                'conversion_rate' => $converted->rate,
                'conversion_time' => $converted->time,
            ]);
            $this->state++;
        }

        /* check the transaction status */
        if ($this->state >= 2)
            return true;

        return false;
    }

    public function withdraw(Wallet $wallet, Account $account, $amount, $type = null, $description = null){
        /* TODO implement withdrawal */
    }

//    public function deposit(Account $account ,Wallet $wallet, $amount, $type = null, $description = null){
    public function deposit(Wallet $wallet, $amount){
        /* TODO implement deposit */
        $wallet->total_balance += $amount;
        $wallet->save();
    }

    public function payout(Wallet $wallet, Account $account, $amount, $type = null, $description = null){
        /* TODO implement payout */
    }

    protected function record($details){
        $transaction = new TransactionRecords();
        $transaction->fill($details);
        $transaction->created_by = Auth::user()->id;
        $transaction->save();
        return $transaction;
    }
}
