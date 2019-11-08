<?php

namespace App\Http\Controllers\Users;

use App\Gender;
use App\Http\Controllers\BaseController;
use App\Http\Resources\GenderResource;
use Illuminate\Http\Request;

class GenderController extends BaseController
{
   public function __construct($model = Gender::class, $resource = GenderResource::class)
   {
       parent::__construct($model, $resource);
   }

    /**
     * @SWG\Get(
     *   path="/gender",
     *   tags={"Gender"},
     *   summary="Retrieve Genders",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
}
