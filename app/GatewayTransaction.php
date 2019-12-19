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

    public static function initCard(Account $account, $amount, $ip= null, $fingerPrint = null) {
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
            'device_fingerprint' => $fingerPrint,
            'bvn' => $account->bvn ?: '',
            'passcode' => $account->passcode ?: '',
            'payment_type' => $account->payment_type ?: '',
            'accountbank' => $account->accountbank ?: '',
        ];

        $transaction = new self();
        $transaction->user_id = Auth::user()->id;
        $transaction->type = 'CARD';
        $transaction->payload = json_encode($card);
        $transaction->created_by = Auth::user()->id;
        $transaction->save();
        return $transaction;
    }

    public static function initAccount(Account $account, $amount, $ip= null, $fingerPrint = null) {
        $account = [
            'accountbank' => $account->accountbank ?: '',
            'accountnumber' => $account->number,
            'currency' => 'NGN', //$account->currency,
            'payment_type' => $account->payment_type ?: '',
            'country' => 'NG', // $account->country,
            'amount' => $amount,
            'passcode' => $account->passcode ?: '',
            'bvn' => $account->bvn ?: '',
            'email' => $account->email,
            'phonenumber' => $account->phonenumber,
            'firstname' => $account->firstname,
            'lastname' => $account->lastname,
            'IP' => $ip ?: '',
            'txRef' => 'PP-'.Carbon::now()->timestamp,
            'device_fingerprint' => $fingerPrint,
        ];

        $transaction = new self();
        $transaction->user_id = Auth::user()->id;
        $transaction->type = 'BANK';
        $transaction->payload = json_encode($account);
        $transaction->created_by = Auth::user()->id;
        $transaction->save();
        return $transaction;
    }

    public static function initModbile(Account $account, $amount, $ip= null, $fingerPrint = null) {
        $account = [
            'phonenumber' => $account->number,
            'currency' => $account->currency,
            'payment_type' => $account->payment_type ?: '',
            'country' => $account->country,
            'amount' => $amount,
            'email' => $account->email,
            'firstname' => $account->firstname,
            'lastname' => $account->lastname,
            'IP' => $ip ?: '',
            'txRef' => 'PP-'.Carbon::now()->timestamp,
            'device_fingerprint' => $fingerPrint,
            'is_mpesa' => $account->is_mpesa,
            'is_mpesa_lipa' => $account->is_mpesa_lipa,
        ];

        $transaction = new self();
        $transaction->user_id = Auth::user()->id;
        $transaction->type = 'BANK';
        $transaction->payload = json_encode($account);
        $transaction->created_by = Auth::user()->id;
        $transaction->save();
        return $transaction;
    }

    public static function initPaypal($amount) {
        $account = [
            'item' => [
                [
                    'name'  => 'Wallet deposit',
                    'price' => $amount,
                    'qty'   => 1,
                ]
            ],
            'invoice' => [
                'invoice_id' => 'PP-'.Carbon::now()->timestamp,
                'invoice_description' => "Wallet Deposit"
            ],
        ];

        $transaction = new self();
        $transaction->user_id = Auth::user()->id;
        $transaction->type = 'PAYPAL';
        $transaction->payload = json_encode($account);
        $transaction->created_by = Auth::user()->id;
        $transaction->save();
        return $transaction;
    }

}