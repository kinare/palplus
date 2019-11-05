<?php

namespace App\Http\Controllers\Investment;

use App\Http\Controllers\BaseController;
use App\Http\Resources\InvestmentOpportunityResource;
use App\InvestmentOpportunity;

class InvestmentOpportunityController extends BaseController
{
    public function __construct($model = InvestmentOpportunity::class, $resource = InvestmentOpportunityResource::class)
    {
        parent::__construct($model, $resource);
    }

    /**
     * @SWG\Get(
     *   path="/investment-opportunity",
     *   tags={"Investment Opportunity"},
     *   summary="Retrieve Investment Opportunity",
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
     *   path="/investment-opportunity",
     *   tags={"Investment Opportunity"},
     *   summary="Create Investment Opportunity",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="title",in="query",description="title",required=true,type="string"),
     *   @SWG\Parameter(name="description",in="query",description="description",required=true,type="string"),
     *   @SWG\Parameter(name="image",in="query",description="image",required=false,type="string"),
     *   @SWG\Parameter(name="featured",in="query",description="featured",required=false,type="string"),
     *   @SWG\Parameter(name="amount",in="query",description="amount",required=false,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */


    /**
     * @SWG\Patch(
     *   path="/investment-opportunity/{id}",
     *   tags={"Investment Opportunity"},
     *   summary="Update Investment Opportunity",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="query",description="Investment opportunity id",required=true,type="string"),
     *   @SWG\Parameter(name="title",in="query",description="title",required=true,type="string"),
     *   @SWG\Parameter(name="description",in="query",description="description",required=true,type="string"),
     *   @SWG\Parameter(name="image",in="query",description="image",required=false,type="string"),
     *   @SWG\Parameter(name="featured",in="query",description="featured",required=false,type="string"),
     *   @SWG\Parameter(name="amount",in="query",description="amount",required=false,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Get(
     *   path="/investment-opportunity/{id}",
     *   tags={"Investment Opportunity"},
     *   summary="Retrieve Investment Opportunity",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Investment opportunity id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/investment-opportunity/{id}",
     *   tags={"Investment Opportunity"},
     *   summary="Delete Investment Opportunity",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Investment opportunity id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/investment-opportunity/{id}/force",
     *   tags={"Investment Opportunity"},
     *   summary="Force delete Investment Opportunity",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Investment opportunity id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */




}
