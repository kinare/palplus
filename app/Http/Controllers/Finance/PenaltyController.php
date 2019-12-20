<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\BaseController;
use App\Http\Resources\PenaltyResource;
use App\Penalty;
use Illuminate\Http\Request;

class PenaltyController extends BaseController
{
    public function __construct($model = Penalty::class, $resource = PenaltyResource::class)
    {
        parent::__construct($model, $resource);
    }

    /**
     * @SWG\Get(
     *   path="/penalties",
     *   tags={"Penalties"},
     *   summary="Member Penalties",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="member id",required=true, type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */

    /**
     * @SWG\Post(
     *   path="/penalties",
     *   tags={"Penalties"},
     *   summary="Create Member Penalties",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="member_id",in="query",description="member id",required=true, type="integer"),
     *   @SWG\Parameter(name="reason",in="query",description="reason",required=true, type="string"),
     *   @SWG\Parameter(name="amount",in="query",description="amount",required=true, type="number"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
}
