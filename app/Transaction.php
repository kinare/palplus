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

    public static function record(Wallet $wallet, $type, $amount, array $details = null){
        $transaction = new self();
        $transaction->wallet_id = $wallet->id;
        $transaction->amount = $amount;
        $transaction->type = $type;
        $transaction->transaction_code = $details ? $details['transaction_code'] : null;
        $transaction->account_no = $details ? $details['account'] : null;
        $transaction->model = $details ? $details['model'] : null;
        $transaction->model_id = $details ? $details['model_id'] : null;
        $transaction->description = $details ? $details['description'] : null;
        $transaction->created_by = Auth::user()->id;
        $transaction->save();
    }
}
