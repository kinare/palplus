<?php

namespace App\Http\Controllers;

use App\GroupSetup;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupSetupController extends BaseController
{
    public function __construct($model = GroupSetup::class, $resource = JsonResource::class)
    {
        parent::__construct($model, $resource);
    }

    /**
     * @SWG\Get(
     *   path="/dashboard/group-setup",
     *   tags={"Dashboard"},
     *   summary="Group setup",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */

    /**
     * @SWG\Post(
     *   path="/dashboard/group-setup",
     *   tags={"Dashboard"},
     *   summary="Create group setups",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="description",in="query",description="description",required=true,type="string"),
     *   @SWG\Parameter(name="currency",in="query",description="currency",required=true,type="string"),
     *   @SWG\Parameter(name="amount",in="query",description="amount",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */

    /**
     * @SWG\Patch(
     *   path="/dashboard/group-setup/{id}",
     *   tags={"Dashboard"},
     *   summary="Edit group setup",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="id",required=true,type="integer"),
     *   @SWG\Parameter(name="description",in="query",description="description",required=true,type="string"),
     *   @SWG\Parameter(name="currency",in="query",description="currency",required=true,type="string"),
     *   @SWG\Parameter(name="amount",in="query",description="amount",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */

    /**
     * @SWG\Get(
     *   path="/dashboard/group-setup/{id}",
     *   tags={"Dashboard"},
     *   summary="Retrieve group setup",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="id",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */


}
