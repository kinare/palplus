<?php

namespace App\Http\Controllers\Contributions;

use App\ContributionType;
use App\Http\Controllers\BaseController;
use App\Http\Resources\ContributionTypeResource;
use Exception;
use Illuminate\Http\Request;

class ContributionTypeController extends BaseController
{
    public function __construct($model = ContributionType::class, $resource = ContributionTypeResource::class)
    {
        parent::__construct($model, $resource);
    }

    /**
     * @SWG\Get(
     *   path="/contribution/types",
     *   tags={"Contributions"},
     *   summary="Retrieve Contributions types",
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
     *   path="/contribution/types",
     *   tags={"Contributions"},
     *   summary="Create Contributions type",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="group_id",in="query",description="group_id",required=true,type="integer"),
     *   @SWG\Parameter(name="contribution_categories_id",in="query",description="contribution_categories_id",required=true,type="integer"),
     *   @SWG\Parameter(name="contribution_periods_id",in="query",description="contribution_periods_id",required=true,type="integer"),
     *   @SWG\Parameter(name="activity_id",in="query",description="activity id",required=false,type="integer"),
     *   @SWG\Parameter(name="name",in="query",description="name",required=true,type="string"),
     *   @SWG\Parameter(name="description",in="query",description="description",required=true,type="string"),
     *   @SWG\Parameter(name="target_amount",in="query",description="target amount",required=true,type="number"),
     *   @SWG\Parameter(name="amount",in="query",description="amount per set period",required=true,type="number"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */


    /**
     * @SWG\Patch(
     *   path="/contribution/types/{id}",
     *   tags={"Contributions"},
     *   summary="Update Contributions",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Contribution type id",required=true,type="string"),
     *   @SWG\Parameter(name="group_id",in="query",description="group_id",required=true,type="integer"),
     *   @SWG\Parameter(name="contribution_categories_id",in="query",description="contribution_categories_id",required=true,type="integer"),
     *   @SWG\Parameter(name="contribution_periods_id",in="query",description="contribution_periods_id",required=true,type="integer"),
     *   @SWG\Parameter(name="activity_id",in="query",description="activity id",required=false,type="integer"),
     *   @SWG\Parameter(name="name",in="query",description="name",required=true,type="string"),
     *   @SWG\Parameter(name="description",in="query",description="description",required=true,type="string"),
     *   @SWG\Parameter(name="target_amount",in="query",description="target amount",required=true,type="number"),
     *   @SWG\Parameter(name="amount",in="query",description="amount per set period",required=true,type="number"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Get(
     *   path="/contribution/types/{id}",
     *   tags={"Contributions"},
     *   summary="Retrieve Contributions type",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Contribution type id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/contribution/types/{id}",
     *   tags={"Contributions"},
     *   summary="Delete Contributions type",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Contribution type id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/contribution/types/{id}/force",
     *   tags={"Contributions"},
     *   summary="Force delete Contributions Type",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Contribution type id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

}
