<?php

namespace App\Http\Controllers\Group;

use App\ActivityType;
use App\Http\Controllers\BaseController;
use App\Http\Resources\ActivityTypeResource;

class ActivityTypeController extends BaseController
{

    public function __construct()
    {
        parent::__construct(ActivityType::class, ActivityTypeResource::class);
    }


    /**
     * @SWG\Get(
     *   path="/activity-type",
     *   tags={"Activity Type"},
     *   summary="Retrieve Activity Types",
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
     *   path="/activity-type",
     *   tags={"Activity Type"},
     *   summary="Create Activity Type",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="activity",in="query",description="activity",required=true,type="string"),
     *   @SWG\Parameter(name="description",in="query",description="description",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */


    /**
     * @SWG\Patch(
     *   path="/activity-type/{id}",
     *   tags={"Activity Type"},
     *   summary="Update Activity Type",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="activity id",required=true,type="string"),
     *   @SWG\Parameter(name="activity",in="query",description="activity",required=true,type="string"),
     *   @SWG\Parameter(name="description",in="query",description="Activity Description",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Get(
     *   path="/activity-type/{id}",
     *   tags={"Activity Type"},
     *   summary="Retrieve Activity Type",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="activity id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/activity-type/{id}",
     *   tags={"Activity Type"},
     *   summary="Delete Activity Type",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="activity id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/activity-type/{id}/force",
     *   tags={"Activity Type"},
     *   summary="Force delete Activity Type",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="activity id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

}
