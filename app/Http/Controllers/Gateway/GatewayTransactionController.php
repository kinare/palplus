<?php

namespace App\Http\Controllers\Gateway;

use App\Account;
use App\AccountType;
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

        dump($gt);

        if (!$gt)
            exit(0);

        $account = Account::where([
            'user_id' => $gt->user_id,
            'account_type_id' => AccountType::type($gt->type)->id
        ])->first();

        dump($account);

        $wallet = Wallet::whereUserId($gt->user_id)->first();

        $data = json_decode($gt->payload);
        $amount = $data->amount;

        $transaction = new Transaction();
        $transaction->deposit($account, $wallet, $amount, 'Deposit', 'Wallet deposit');

        if ($transaction){
            $gt->status = 'done';
            $gt->save();
        }
    }
}
