<?php

namespace App\Http\Controllers\Finance;

use App\Account;
use App\Http\Controllers\BaseController;
use App\Http\Resources\AccountResource;
use Illuminate\Http\Request;

class AccountController extends BaseController
{
    public function __construct($model = Account::class, $resource = AccountResource::class)
    {
        parent::__construct($model, $resource);
    }

    /**
     * @SWG\Get(
     *   path="/accounts",
     *   tags={"Accounts"},
     *   summary="Retrieve Accounts",
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
     * @SWG\Post(
     *   path="/accounts",
     *   tags={"Accounts"},
     *   summary="Create Accounts",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="account_type_id",in="query",description="account type id",required=true,type="integer"),
     *   @SWG\Parameter(name="user_id",in="query",description="user id",required=true,type="integer"),
     *   @SWG\Parameter(name="number",in="query",description="number",required=true,type="string"),
     *   @SWG\Parameter(name="name",in="query",description="name",required=false,type="string"),
     *   @SWG\Parameter(name="address",in="query",description="address",required=false,type="string"),
     *   @SWG\Parameter(name="country",in="query",description="country",required=false,type="string"),
     *   @SWG\Parameter(name="cvv",in="query",description="cvv",required=false,type="string"),
     *   @SWG\Parameter(name="limit",in="query",description="limit",required=false,type="number"),
     *   @SWG\Parameter(name="expiry",in="query",description="expiry",required=false,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */

    /**
     * @SWG\Patch(
     *   path="/accounts/{id}",
     *   tags={"Accounts"},
     *   summary="Update Account",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="account id",required=true,type="string"),
     *   @SWG\Parameter(name="number",in="query",description="number",required=true,type="string"),
     *   @SWG\Parameter(name="name",in="query",description="name",required=false,type="string"),
     *   @SWG\Parameter(name="address",in="query",description="address",required=false,type="string"),
     *   @SWG\Parameter(name="country",in="query",description="country",required=false,type="string"),
     *   @SWG\Parameter(name="cvv",in="query",description="cvv",required=false,type="string"),
     *   @SWG\Parameter(name="limit",in="query",description="limit",required=false,type="number"),
     *   @SWG\Parameter(name="expiry",in="query",description="expiry",required=false,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Get(
     *   path="/accounts/{id}",
     *   tags={"Accounts"},
     *   summary="Retrieve an Account",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="account id",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/accounts/{id}",
     *   tags={"Accounts"},
     *   summary="Delete Account",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="account id",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/accounts/{id}/force",
     *   tags={"Accounts"},
     *   summary="Force delete Account",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="account id",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
}
