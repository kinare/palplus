<?php

namespace App\Http\Controllers\Finance;

use App\AccountType;
use App\Http\Controllers\BaseController;
use App\Http\Resources\AccountTypeResource;
use Illuminate\Http\Request;

class AccountTypeController extends BaseController
{
   public function __construct($model = AccountType::class, $resource = AccountTypeResource::class)
   {
       parent::__construct($model, $resource);
   }

    /**
     * @SWG\Get(
     *   path="/accounts/types",
     *   tags={"Accounts"},
     *   summary="Retrieve Account types",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
}
