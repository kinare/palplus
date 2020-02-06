<?php

namespace App\Http\Controllers;

use App\AdvertSetup;
use App\Http\Resources\AdvertSetupResource;
use Illuminate\Http\Request;

class AdvertSetupController extends BaseController
{
    public function __construct($model = AdvertSetup::class, $resource = AdvertSetupResource::class)
    {
        parent::__construct($model, $resource);
    }

    /**
     * @SWG\Get(
     *   path="/dashboard/advert-setup",
     *   tags={"Dashboard"},
     *   summary="Advert setups",
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
     *   path="/dashboard/advert-setup",
     *   tags={"Dashboard"},
     *   summary="Create Advert setups",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="type",in="query",description="type",required=true,type="string"),
     *   @SWG\Parameter(name="description",in="query",description="description",required=true,type="string"),
     *   @SWG\Parameter(name="rate",in="query",description="rate",required=true,type="string"),
     *   @SWG\Parameter(name="currency",in="query",description="currency",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */

    /**
     * @SWG\Patch(
     *   path="/dashboard/advert-setup/{id}",
     *   tags={"Dashboard"},
     *   summary="Edit Advert setup",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="type",required=true,type="integer"),
     *   @SWG\Parameter(name="type",in="query",description="type",required=true,type="string"),
     *   @SWG\Parameter(name="description",in="query",description="description",required=true,type="string"),
     *   @SWG\Parameter(name="rate",in="query",description="rate",required=true,type="string"),
     *   @SWG\Parameter(name="currency",in="query",description="currency",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */

    /**
     * @SWG\Get(
     *   path="/dashboard/advert-setup/{id}",
     *   tags={"Dashboard"},
     *   summary="Retrieve Advert setup",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="type",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/dashboard/advert-setup/{id}",
     *   tags={"Dashboard"},
     *   summary="Delete Advert setup",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="type",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
}
