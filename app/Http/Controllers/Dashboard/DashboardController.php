<?php

namespace App\Http\Controllers\Dashboard;

use App\Group;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Currency\CurrencyController;
use App\Http\Controllers\Finance\TransactionController;
use App\Http\Controllers\Finance\WithdrawalController;
use App\Http\Controllers\Group\GroupController;
use App\Http\Controllers\Investment\InvestmentOpportunityController;
use App\Http\Controllers\Loan\LoanController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\Users\UserController;
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

    /**
     * @SWG\Get(
     *   path="/dashboard/currency",
     *   tags={"Dashboard"},
     *   summary="Get currency",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function currency(){
        $currency = new CurrencyController();
        return $currency->index();
    }

    /**
     * @SWG\Get(
     *   path="/dashboard/wallet",
     *   tags={"Dashboard"},
     *   summary="Get wallets",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function wallets(){
        $wallet = new \App\Http\Controllers\Finance\WalletController();
        return $wallet->index();
    }

    /**
     * @SWG\Get(
     *   path="/dashboard/wallet/transactions",
     *   tags={"Dashboard"},
     *   summary="Get wallet transactions",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function walletTransactions(){
        $transactions = new TransactionController();
        return $transactions->index();
    }

    /**
     * @SWG\Get(
     *   path="/dashboard/admins",
     *   tags={"Dashboard"},
     *   summary="Get admins",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function admins(){
        $admins = new AdminController();
        return $admins->index();
    }

    /**
     * @SWG\Get(
     *   path="/dashboard/groups",
     *   tags={"Dashboard"},
     *   summary="Get groups",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function groups(){
        $groups= new GroupController();
        return $groups->index();
    }

    /**
     * @SWG\Get(
     *   path="/dashboard/members",
     *   tags={"Dashboard"},
     *   summary="Get members",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function members(){
        $members= new UserController();
        return $members->index();
    }

    /**
     * @SWG\Get(
     *   path="/dashboard/transactions",
     *   tags={"Dashboard"},
     *   summary="Get transactions",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function transactions(){
        $transactions= new TransactionController();
        return $transactions->index();
    }

    /**
     * @SWG\Get(
     *   path="/dashboard/investments",
     *   tags={"Dashboard"},
     *   summary="Get investments",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function investments(){
        $investments = new InvestmentOpportunityController();
        return $investments->index();
    }

    /**
     * @SWG\Get(
     *   path="/dashboard/loans",
     *   tags={"Dashboard"},
     *   summary="Get loans",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function loans(){
        $loans = new LoanController();
        return $loans->index();
    }

    /**
     * @SWG\Get(
     *   path="/dashboard/withdrawal-requests",
     *   tags={"Dashboard"},
     *   summary="Get withdrawal-requests",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function withdrawalRequests(){
        $w = new WithdrawalController();
        return $w->index();
    }




}
