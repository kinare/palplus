<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\User;
use App\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    /**
     * @SWG\Get(
     *   path="/dashboard/wallet",
     *   tags={"Dashboard"},
     *   summary="Get dashboard wallet",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    public function index(){
        //get stats
        return [
            'data' => [
                'total_balance' => Wallet::total('total_balance'),
                'group_wallets' =>  Wallet::total('Group', 'total_balance'), //'Group', 'User'
                'personal_wallets' =>  Wallet::total('User', 'total_balance'),
                'total_withdrawal' => Wallet::total('total_withdrawals'),
                'total_deposits' => Wallet::total('total_deposits'),
                'users' => count(User::all()),
                'active_users' => count(Wallet::where('type','User')->where('total_balance', '>', 0)->get()),
                'today' => [
                    'total_deposits' => '',
                    'total_withdrawals' => '',
                ],
            ]
        ];


    }
}
