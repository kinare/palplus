<?php

namespace App\Http\Controllers\Finance;

use App\Account;
use App\AccountType;
use App\GatewayTransaction;
use App\Group;
use App\Http\Controllers\BaseController;
use App\Http\Resources\WalletResource;
use App\Lib\Rave\Card;
use App\User;
use App\Wallet;
use Illuminate\Http\Request;

class WalletController extends BaseController
{
    public function __construct($model = Wallet::class, $resource = WalletResource::class)
    {
        parent::__construct($model, $resource);
    }

    /**
     * @SWG\Get(
     *   path="/wallet",
     *   tags={"Wallets"},
     *   summary="Retrieve Wallets",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Get(
     *   path="/wallet/{id}",
     *   tags={"Wallets"},
     *   summary="Retrieve a Wallet",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="wallet id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
}
