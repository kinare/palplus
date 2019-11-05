<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\BaseController;
use App\Http\Resources\NextOfKinResource;
use App\NextOfKin;
use Illuminate\Http\Request;

class NextOfKinController extends BaseController
{
    public function __construct($model = NextOfKin::class, $resource = NextOfKinResource::class)
    {
        parent::__construct($model, $resource);
    }

    /**
     * @SWG\Get(
     *   path="/nok",
     *   tags={"Next of Kin"},
     *   summary="All Next of Kins",
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
     *   path="/nok",
     *   tags={"Next of Kin"},
     *   summary="Create Next of Kin",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="user_id",in="query",description="User Id",required=true,type="string"),
     *   @SWG\Parameter(name="name",in="query",description="name",required=true,type="string"),
     *   @SWG\Parameter(name="gender",in="query",description="gender",required=true,type="string"),
     *   @SWG\Parameter(name="dob",in="query",description="Date of Birth",required=true,type="string"),
     *   @SWG\Parameter(name="relationship",in="query",description="relationship",required=false,type="string"),
     *   @SWG\Parameter(name="phone",in="query",description="phone",required=false,type="string"),
     *   @SWG\Parameter(name="email",in="query",description="email",required=false,type="string"),
     *   @SWG\Parameter(name="physical_address",in="query",description="physical address",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Patch(
     *   path="/nok/{id}",
     *   tags={"Next of Kin"},
     *   summary="Update a Next of Kin",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Next of kin Id",required=true,type="string"),
     *   @SWG\Parameter(name="name",in="query",description="name",required=true,type="string"),
     *   @SWG\Parameter(name="gender",in="query",description="gender",required=true,type="string"),
     *   @SWG\Parameter(name="dob",in="query",description="Date of Birth",required=true,type="string"),
     *   @SWG\Parameter(name="relationship",in="query",description="relationship",required=false,type="string"),
     *   @SWG\Parameter(name="phone",in="query",description="phone",required=false,type="string"),
     *   @SWG\Parameter(name="email",in="query",description="email",required=false,type="string"),
     *   @SWG\Parameter(name="physical_address",in="query",description="physical address",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Get(
     *   path="/nok/{id}",
     *   tags={"Next of Kin"},
     *   summary="Retrieve Next of Kin",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Next of kin Id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/nok/{id}",
     *   tags={"Next of Kin"},
     *   summary="Soft delete a Next of Kin",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Next of kin Id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/nok/{id}/force",
     *   tags={"Next of Kin"},
     *   summary="Force delete a Next of Kin",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Next of kin Id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

}
