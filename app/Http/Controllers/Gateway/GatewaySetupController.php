<?php

namespace App\Http\Controllers\Gateway;

use App\GatewaySetup;
use App\Http\Controllers\BaseController;
use App\Http\Resources\GatewaySetupResource;
use Illuminate\Http\Request;

class GatewaySetupController extends BaseController
{
    public function __construct($model = GatewaySetup::class, $resource = GatewaySetupResource::class)
    {
        parent::__construct($model, $resource);
    }

    /**
     * @SWG\Get(
     *   path="/gateway/setup",
     *   tags={"Gateway"},
     *   summary="Retrieve Gateway setups",
 *      security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */

    /**
     * @SWG\Post(
     *   path="/gateway/setup",
     *   tags={"Gateway"},
     *   summary="Create Gateway Setup",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="type",in="query",description="type",required=true, type="string"),
     *   @SWG\Parameter(name="gateway",in="query",description="gateway",required=true, type="string"),
     *   @SWG\Parameter(name="rate",in="query",description="rate",required=true, type="number"),
     *   @SWG\Parameter(name="active",in="query",description="active",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */

    /**
     * @SWG\Patch(
     *   path="/gateway/setup/{id}",
     *   tags={"Gateway"},
     *   summary="Update Gateway Setup",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="setup id",required=true, type="integer"),
     *   @SWG\Parameter(name="type",in="query",description="type",required=true, type="string"),
     *   @SWG\Parameter(name="gateway",in="query",description="gateway",required=true, type="string"),
     *   @SWG\Parameter(name="rate",in="query",description="rate",required=true, type="number"),
     *   @SWG\Parameter(name="active",in="query",description="active",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */


    /**
     * @SWG\Get(
     *   path="/gateway/setup/{id}",
     *   tags={"Gateway"},
     *   summary="Fetch Gateway Setup",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="setup id",required=true, type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/gateway/setup/{id}",
     *   tags={"Gateway"},
     *   summary="Delete Gateway Setup",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="setup id",required=true, type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */


}
