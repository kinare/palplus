<?php

namespace App\Http\Controllers\Finance;

use App\Wallet;
use Exception;
use Illuminate\Support\Facades\Auth;

class Accounting
{
    /**
     * @param Wallet $wallet
     * @param $amount
     * @return Wallet
     * @throws Exception
     */
    protected function credit(Wallet $wallet,  $amount)
    {
        try{
            $wallet->total_balance = (float)$amount + (float)$wallet->total_balance;
            $wallet->total_deposits = (float)$amount + (float)$wallet->total_deposits;
            $wallet->modified_by = $wallet->user_id;
            $wallet->save();
            return $wallet;
        }catch (Exception $exception){
            throw $exception;
        }

    }

    /**
     * @param Wallet $wallet
     * @param $amount
     * @return Wallet
     * @throws Exception
     */
    protected function debit(Wallet $wallet, $amount)
    {
        try{
            $wallet->total_balance = (float)$wallet->total_balance - (float)$amount;
            $wallet->total_withdrawals = (float)$amount + (float)$wallet->total_withdrawals;
            $wallet->modified_by =  $wallet->user_id;
            $wallet->save();
            return $wallet;
        }catch (Exception $exception){
            throw $exception;
        }
    }
}
