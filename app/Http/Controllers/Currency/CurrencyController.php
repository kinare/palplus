<?php

namespace App\Http\Controllers\Currency;

use App\Currency;
use App\Http\Controllers\BaseController;
use App\Http\Resources\CurrencyResource;

class CurrencyController extends BaseController
{
    public function __construct($model = Currency::class, $resource = CurrencyResource::class)
    {
        parent::__construct($model, $resource);
    }


    /**
     * @SWG\Get(
     *   path="/currency",
     *   tags={"Currency"},
     *   summary="Retrieve Currencies",
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Post(
     *   path="/currency",
     *   tags={"Currency"},
     *   summary="Create currency",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="currency",in="query",description="currency",required=true,type="string"),
     *   @SWG\Parameter(name="short_description",in="query",description="short_description",required=true,type="string"),
     *   @SWG\Parameter(name="country",in="query",description="country",required=true,type="string"),
     *   @SWG\Parameter(name="rate",in="query",description="rate",required=true,type="number"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Patch(
     *   path="/currency/{id}",
     *   tags={"Currency"},
     *   summary="Update currency",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="currency id",required=true,type="string"),
     *   @SWG\Parameter(name="currency",in="query",description="currency",required=true,type="string"),
     *   @SWG\Parameter(name="short_description",in="query",description="short_description",required=true,type="string"),
     *   @SWG\Parameter(name="country",in="query",description="country",required=true,type="string"),
     *   @SWG\Parameter(name="rate",in="query",description="rate",required=true,type="number"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Get(
     *   path="/currency/{id}",
     *   tags={"Currency"},
     *   summary="Retrieve Currency",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="currency id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/currency/{id}",
     *   tags={"Currency"},
     *   summary="Delete currency",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="currency id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/currency/{id}/force",
     *   tags={"Currency"},
     *   summary="Force delete currency",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="currency id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */



}
