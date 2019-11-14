<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Transaction extends BaseModel
{
    protected $fillable = [
        'wallet_id',
        'type',
        'transaction_code',
        'account_no',
        'amount',
    ];

    public static function record(Wallet $wallet, $type, $amount, $transaction_code = null, $account_no = null){
        $transaction = new self();
        $transaction->wallet_id = $wallet->id;
        $transaction->amount = $amount;
        $transaction->type = $type;
        $transaction->transaction_code = $transaction_code;
        $transaction->account_no = $account_no;
        $transaction->created_by = Auth::user()->id;
        $transaction->save();
    }
}
