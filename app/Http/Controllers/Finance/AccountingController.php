<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\Wallet;
use Illuminate\Support\Facades\Auth;

class AccountingController extends Controller
{
    /**
     * @param Wallet $wallet
     * @param $amount
     * @throws \Exception
     */
    public static function credit(Wallet $wallet,  $amount)
    {
        try{
            $wallet->total_balance = (float)$amount + (float)$wallet->total_balance;
            $wallet->total_deposits = (float)$amount + (float)$wallet->total_deposits;
            $wallet->modified_by = Auth::user()->id;
            $wallet->save();

            //record transaction
            Transaction::record($wallet, 'credit', $amount);
        }catch (\Exception $exception){
            throw $exception;
        }

    }

    /**
     * @param Wallet $wallet
     * @param $amount
     * @throws \Exception
     */
    public static function debit(Wallet $wallet, $amount)
    {
        try{
            $wallet->total_balance = (float)$wallet->total_balance - (float)$amount;
            $wallet->total_withdrawals = (float)$amount + (float)$wallet->total_withdrawals;
            $wallet->modified_by = Auth::user()->id;
            $wallet->save();

            //record transaction
            Transaction::record($wallet, 'debit', $amount);
        }catch (\Exception $exception){
            throw $exception;
        }
    }

    /**
     * @param Wallet $from
     * @param Wallet $to
     * @param $amount
     * @throws \Exception
     */
    public static function transact(Wallet $from, Wallet $to, $amount)
    {
        try{
           self::debit($from, $amount);
           self::credit($to, $amount);
        }catch (\Exception $exception){
            throw $exception;
        }
    }
}
