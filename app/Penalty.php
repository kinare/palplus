<?php

namespace App;

use App\Http\Controllers\Finance\Transaction;
use Illuminate\Database\Eloquent\Model;

class Penalty extends BaseModel
{
    protected $fillable = [
        'member_id',
        'reason',
        'amount',
    ];

    public static function pay(self $penalty, Members $members, $amount){
        $transaction = new Transaction();
        $transaction->transact(
            Wallet::mine(),
            Wallet::group($members->group_id),
            $amount,
            'Penalty',
            $penalty->reason
        );
        return $transaction;
    }
}
