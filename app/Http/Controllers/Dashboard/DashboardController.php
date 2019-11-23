<?php

namespace App\Http\Controllers\Dashboard;

use App\Group;
use App\Http\Controllers\Controller;
use App\Loan;
use App\User;
use App\Wallet;

class DashboardController extends Controller
{
    /**
     * @SWG\Get(
     *   path="/dashboard",
     *   tags={"Dashboard"},
     *   summary="Get dashboard stats",
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
                'groups' => count(Group::all()),
                'wallets' => Wallet::total(),
                'users' => count(User::all()),
                'loans' => Loan::total()
            ]
        ];


    }
}
