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
        ];

        $transaction = new self();
        $transaction->user_id = Auth::user()->id;
        $transaction->ref = $card['txRef'];
        $transaction->type = $account->id;
        $transaction->payload = json_encode($card);
        $transaction->transaction = 'DEPOSIT';
        $transaction->created_by = Auth::user()->id;
        $transaction->save();
        return $transaction;
    }

    public static function initAccount(Account $account, $amount, $ip= null, $fingerPrint = null) {
        $data = [
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
        $transaction->ref = $data['txRef'];
        $transaction->type = $account->id;
        $transaction->payload = json_encode($data);
        $transaction->transaction = 'DEPOSIT';
        $transaction->created_by = Auth::user()->id;
        $transaction->save();
        return $transaction;
    }

    public static function initMobile(Account $account, $amount, $ip= null, $fingerPrint = null) {
        $data = [
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
        $transaction->ref = $data['txRef'];
        $transaction->user_id = Auth::user()->id;
        $transaction->type = $account->id;
        $transaction->payload = json_encode($data);
        $transaction->transaction = 'DEPOSIT';
        $transaction->created_by = Auth::user()->id;
        $transaction->save();
        return $transaction;
    }

    public static function initPaypal(Account $account, $amount) {
        $data = [
            'item' => [
                    'name'  => 'Wallet deposit',
                    'currency'  => env('PAYPAL_CURRENCY'),
                    'amount' =>   Converter::Convert(Wallet::mine()->currencyShortDesc(), env('PAYPAL_CURRENCY'), $amount)['amount'],
                    'qty'   => 1,
            ],
            'invoice' => [
                'invoice_no' => 'PP-'.Carbon::now()->timestamp,
                'description' => "Wallet Deposit"
            ],
        ];

        $transaction = new self();
        $transaction->user_id = Auth::user()->id;
        $transaction->type = $account->id;
        $transaction->ref = $data['invoice']['invoice_no'];
        $transaction->payload = json_encode($data);
        $transaction->transaction = 'DEPOSIT';
        $transaction->created_by = Auth::user()->id;
        $transaction->save();
        return $transaction;
    }

    public static function initPaypalPayout(Account $account, $amount) {

        $data = [
            'receiver'  => [
                    'email' => 'sb-qpdxr528392@personal.example.com', //$account->number,
                    'amount' => Converter::Convert(Wallet::mine()->currencyShortDesc(), env('PAYPAL_CURRENCY'), $amount)['amount']
            ],
            'invoice' => [
                'invoice_no' => 'PP-'.Carbon::now()->timestamp,
                'description' => "Wallet Withdrawal"
            ],
        ];

        $transaction = new self();
        $transaction->user_id = Auth::user()->id;
        $transaction->type = $account->id;
        $transaction->ref = $data['invoice']['invoice_no'];
        $transaction->payload = json_encode($data);
        $transaction->transaction = 'WITHDRAWAL';
        $transaction->created_by = Auth::user()->id;
        $transaction->save();
        return $transaction;
    }

    public static function bankTransfer(Account $account, $amount){
        $data = [
            'account_bank' => $account->accountbank,
            'account_number' => $account->number,
            'amount' => $amount,
            'narration' => 'Yunited wallet withdrawal',
            'currency' => $account->currency,
            'reference' => 'PP-'.Carbon::now()->timestamp.'_PMCKDU_1',
            'callback_url' => 'http://35.200.214.94/api/gateway/rave/hook',
            'beneficiary_name' => $account->beneficiary,
        ];

        $transaction = new self();
        $transaction->user_id = Auth::user()->id;
        $transaction->type = $account->id;
        $transaction->ref = $data['reference'];
        $transaction->payload = json_encode($data);
        $transaction->transaction = 'WITHDRAWAL';
        $transaction->created_by = Auth::user()->id;
        $transaction->save();
        return $transaction;
    }

    public static function mobileTransfer(Account $account, $amount){
        $data = [
            'account_bank' => 'MPS',
            'account_number' => $account->number,
            'amount' => $amount,
            'narration' => 'Yunited wallet withdrawal',
            'currency' => $account->currency,
            'callback_url' => 'http://35.200.214.94/api/gateway/rave/hook',
            'reference' => 'PP-'.Carbon::now()->timestamp.'_PMCKDU_1',
            'beneficiary_name' => $account->beneficiary,
        ];

        $transaction = new self();
        $transaction->user_id = Auth::user()->id;
        $transaction->type = $account->id;
        $transaction->ref = $data['reference'];
        $transaction->payload = json_encode($data);
        $transaction->transaction = 'WITHDRAWAL';
        $transaction->created_by = Auth::user()->id;
        $transaction->save();
        return $transaction;
    }



}
