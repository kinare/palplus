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
        'entry',
        'transaction_from',
        'transaction_to',
        'type',
        'description',
        'from_currency',
        'to_currency',
        'conversion_rate',
        'conversion_time',
    ];
}
