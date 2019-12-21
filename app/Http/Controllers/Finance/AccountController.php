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
     *   @SWG\Parameter(name="firstname",in="query",description="firstname",required=false,type="string"),
     *   @SWG\Parameter(name="lastname",in="query",description="lastname",required=false,type="string"),
     *   @SWG\Parameter(name="email",in="query",description="email",required=false,type="string"),
     *   @SWG\Parameter(name="phonenumber",in="query",description="phonenumber",required=false,type="string"),
     *   @SWG\Parameter(name="address",in="query",description="address",required=false,type="string"),
     *   @SWG\Parameter(name="country",in="query",description="country",required=false,type="string"),
     *   @SWG\Parameter(name="currency_id",in="query",description="currency",required=false,type="string"),
     *   @SWG\Parameter(name="cvv",in="query",description="cvv",required=false,type="string"),
     *   @SWG\Parameter(name="billingzip",in="query",description="billingzip",required=false,type="string"),
     *   @SWG\Parameter(name="billingcity",in="query",description="billingcity",required=false,type="string"),
     *   @SWG\Parameter(name="billingaddress",in="query",description="billingaddress",required=false,type="string"),
     *   @SWG\Parameter(name="billingstate",in="query",description="billingstate",required=false,type="string"),
     *   @SWG\Parameter(name="billingcountry",in="query",description="billingcountry",required=false,type="string"),
     *   @SWG\Parameter(name="expirymonth",in="query",description="expirymonth",required=false,type="string"),
     *   @SWG\Parameter(name="expiryyear",in="query",description="expiryyear",required=false,type="string"),
     *   @SWG\Parameter(name="bvn",in="query",description="bvn",required=false,type="string"),
     *   @SWG\Parameter(name="passcode",in="query",description="passcode",required=false,type="string"),
     *   @SWG\Parameter(name="accountbank",in="query",description="bank code",required=false,type="string"),
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
     *   @SWG\Parameter(name="firstname",in="query",description="firstname",required=false,type="string"),
     *   @SWG\Parameter(name="lastname",in="query",description="lastname",required=false,type="string"),
     *   @SWG\Parameter(name="email",in="query",description="email",required=false,type="string"),
     *   @SWG\Parameter(name="phonenumber",in="query",description="phonenumber",required=false,type="string"),
     *   @SWG\Parameter(name="address",in="query",description="address",required=false,type="string"),
     *   @SWG\Parameter(name="country",in="query",description="country",required=false,type="string"),
     *   @SWG\Parameter(name="currency_id",in="query",description="currency",required=false,type="string"),
     *   @SWG\Parameter(name="cvv",in="query",description="cvv",required=false,type="string"),
     *   @SWG\Parameter(name="billingzip",in="query",description="billingzip",required=false,type="string"),
     *   @SWG\Parameter(name="billingcity",in="query",description="billingcity",required=false,type="string"),
     *   @SWG\Parameter(name="billingaddress",in="query",description="billingaddress",required=false,type="string"),
     *   @SWG\Parameter(name="billingstate",in="query",description="billingstate",required=false,type="string"),
     *   @SWG\Parameter(name="billingcountry",in="query",description="billingcountry",required=false,type="string"),
     *   @SWG\Parameter(name="expirymonth",in="query",description="expirymonth",required=false,type="string"),
     *   @SWG\Parameter(name="expiryyear",in="query",description="expiryyear",required=false,type="string"),
     *   @SWG\Parameter(name="bvn",in="query",description="bvn",required=false,type="string"),
     *   @SWG\Parameter(name="passcode",in="query",description="passcode",required=false,type="string"),
     *   @SWG\Parameter(name="accountbank",in="query",description="bank code",required=false,type="string"),
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
