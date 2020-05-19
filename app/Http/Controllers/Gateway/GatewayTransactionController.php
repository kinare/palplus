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
        $amount = self::addTransactionFee('RAVE', $gt->transaction , $data->amount);

        try {
            $transaction = new Transaction();
            if ($gt->transaction === 'DEPOSIT')
				$transaction->deposit($account, $wallet, $amount, 'Deposit', 'Wallet deposit');
				$wallet->total_balance = $wallet->total_balance + $amount;
				$wallet->total_deposits = $wallet->total_deposits + $amount;
				$wallet->save();

            if ($gt->transaction === 'WITHDRAWAL')
				$transaction->withdraw($account, $wallet, $amount, 'Withdraw', 'Wallet withdrawal');
				$wallet->total_balance = $wallet->total_balance - $amount;
				$wallet->total_deposits = $wallet->total_deposits - $amount;
				$wallet->save();
				
        }catch (\Exception $e){
            return $e;
        }

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
