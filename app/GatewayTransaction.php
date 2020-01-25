<?php

namespace App;


use App\Http\Controllers\Currency\Converter;
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
            'amount' => self::addTransactionFee('Rave', 'Deposit', $amount),
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
        ];

        $transaction = new self();
        $transaction->user_id = Auth::user()->id;
        $transaction->ref = $card['txRef'];
        $transaction->type = 'CARD DEPOSIT';
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
            'amount' => self::addTransactionFee('Rave', 'Deposit', $amount),
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
        $transaction->ref = $account['txRef'];
        $transaction->type = 'BANK DEPOSIT';
        $transaction->payload = json_encode($account);
        $transaction->created_by = Auth::user()->id;
        $transaction->save();
        return $transaction;
    }

    public static function initMobile(Account $account, $amount, $ip= null, $fingerPrint = null) {
        $account = [
            'phonenumber' => $account->number,
            'currency' => $account->currency,
            'payment_type' => $account->payment_type ?: '',
            'country' => $account->country,
            'amount' => self::addTransactionFee('Rave', 'Deposit', $amount),
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
        $transaction->ref = $account['txRef'];
        $transaction->user_id = Auth::user()->id;
        $transaction->type = 'MOBILE DEPOSIT';
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
                    'price' =>   Converter::Convert(Wallet::mine()->currencyShortDesc(), 'USD', $amount)['amount'],
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
        $transaction->type = 'PAYPAL DEPOTI';
        $transaction->ref = $account['invoice']['invoice_id'];
        $transaction->payload = json_encode($account);
        $transaction->created_by = Auth::user()->id;
        $transaction->save();
        return $transaction;
    }

    public static function initPaypalPayout(Account $account, $amount) {

        $data = [
            'receivers'  => [
                    'email' => $account->number,
                    'amount' => $amount,
            ],
            'payer' => 'EACHRECEIVER', // (Optional) Describes who pays PayPal fees. Allowed values are: 'SENDER', 'PRIMARYRECEIVER', 'EACHRECEIVER' (Default), 'SECONDARYONLY'
            'return_url' => url('api/gateway/paypal/ec-payout-success'),
            'cancel_url' => url('payment/cancel'),
        ];

        $transaction = new self();
        $transaction->user_id = Auth::user()->id;
        $transaction->type = 'PAYPAL WITHDRAWAL';
        $transaction->ref = 'PP-'.Carbon::now()->timestamp;
        $transaction->payload = json_encode($data);
        $transaction->created_by = Auth::user()->id;
        $transaction->save();
        return $transaction;
    }

    public static function bankTransfer(Account $account, $amount){
        $data = [
            'account_bank' => $account->accountbank,
            'account_number' => $account->number,
            'amount' =>self::addTransactionFee('Rave', 'Withdrawal', $amount),
            'narration' => 'Yunited wallet withdrawal',
            'currency' => $account->currency,
            'seckey' => '',
            'reference' => 'PP-'.Carbon::now()->timestamp,
            'callback_url' => '',
            'beneficiary_name' => $account->beneficiary,
        ];

        $transaction = new self();
        $transaction->user_id = Auth::user()->id;
        $transaction->type = 'BANK WITHDRAWAL';
        $transaction->ref = $data['reference'];
        $transaction->payload = json_encode($data);
        $transaction->created_by = Auth::user()->id;
        $transaction->save();
        return $transaction;
    }

    public static function addTransactionFee($gateway, $type, $amount){
        $setup = GatewaySetup::getSetup($gateway, $type);
        if (!$setup || $setup->rate === 0)
            return $amount;

        return (float)$amount + $setup->getTransactionFee($amount);
    }

}
