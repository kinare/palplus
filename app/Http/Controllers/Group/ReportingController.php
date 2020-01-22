<?php

namespace App\Http\Controllers\Group;

use App\Http\Controllers\BaseController;
use App\Http\Resources\ReportingResource;
use App\Reporting;
use Illuminate\Http\Request;

class ReportingController extends BaseController
{
    public function __construct($model = Reporting::class, $resource = ReportingResource::class)
    {
        parent::__construct($model, $resource);
    }

    /**
     * @SWG\Get(
     *   path="/reporting",
     *   tags={"Reporting"},
     *   summary="Retrieve reportings",
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
     *   path="/reporting",
     *   tags={"Reporting"},
     *   summary="Create Reporting",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="user_id",in="query",description="user id",required=true,type="integer"),
     *   @SWG\Parameter(name="group_id",in="query",description="group id",required=true,type="integer"),
     *   @SWG\Parameter(name="message",in="query",description="message",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */

    /**
     * @SWG\Get(
     *   path="/reporting/{id}",
     *   tags={"Reporting"},
     *   summary="Fetch Reporting",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="reporting id",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */



}
