<?php

namespace App;


use Auth;
use Carbon\Carbon;

class GatewayTransaction extends BaseModel
{
    protected $fillable = [
        'user_id',
        'type',
        'payload',
    ];

    public static function initCard(Account $account, $amount, $ip= null) {
        $card = [
            'cardno' => $account->number,
            'cvv' => $account->cvv,
            'expirymonth' => $account->expirymonth,
            'expiryyear' => $account->expiryyear,
            'currency' => $account->currency,
            'country' => $account->country,
            'amount' => $amount,
            'email' => $account->email,
            'phonenumber' => $account->phonenumber,
            'firstname' => $account->firstname,
            'lastname' => $account->lastname,
            'billingzip' => $account->billingzip,
            'billingcity' => $account->billingcity,
            'billingaddress' => $account->billingaddress,
            'billingstate' => $account->billingstate,
            'billingcountry' => $account->billingcountry,
            'IP' => $ip ?: '',
            'txRef' => 'PP-'.Carbon::now()->timestamp,
        ];

        $transaction = new self();
        $transaction->user_id = Auth::user()->id;
        $transaction->type = 'CARD';
        $transaction->payload = json_encode($card);
        $transaction->created_by = Auth::user()->id;
        $transaction->save();
        return $transaction;
    }


}
