<?php

namespace App\Http\Controllers\Gateway;

use App\Account;
use App\AccountType;
use App\GatewaySetup;
use App\GatewayTransaction;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Finance\Transaction;
use App\Wallet;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Self_;

class GatewayTransactionController extends Controller
{
    public static function processTransaction($txref){

        if (!$txref)
            exit(0);

        $gt = GatewayTransaction::where([
            'ref' => $txref,
            'status' => 'pending'
        ])->first();

        if (!$gt)
            exit(0);

        $account = Account::find($gt->type);

        $wallet = Wallet::whereUserId($gt->user_id)->first();

        $data = json_decode($gt->payload);
        $amount = $data->amount;

        $transaction = new Transaction();
        if ($gt->transaction = 'DEPOSIT')
            $transaction->deposit($account, $wallet, $amount, 'Deposit', 'Wallet deposit');

        if ($gt->transaction = 'WITHDRAWAL')
            $transaction->withdraw($account, $wallet, $amount, 'Withdraw', 'Wallet withdrawal');

        if ($transaction){
            $gt->status = 'done';
            $gt->save();
        }
    }

    public static function addTransactionFee($gateway, $type, $amount){
        $setup = GatewaySetup::getSetup($gateway, $type);
        if (!$setup || $setup->rate === 0)
            return $amount;

        return (float)$amount + $setup->getTransactionFee($amount);
    }

}
