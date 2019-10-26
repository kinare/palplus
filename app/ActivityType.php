<?php

namespace App;

use App\Http\Controllers\BaseController;
use App\Http\Resources\ActivityTypeResource;
use Illuminate\Database\Eloquent\Model;

class ActivityType extends BaseController
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
     *   summary="Create Activity Typ",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="group_id",in="query",description="Group id",required=true,type="string"),
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
     *   summary="Update Activity Typ",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="name",in="query",description="Group Name",required=true,type="string"),
     *   @SWG\Parameter(name="description",in="query",description="Group Description",required=true,type="string"),
     *   @SWG\Parameter(name="access_level",in="query",description="access level",required=true,type="string"),
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
     *   summary="Retrieve Activity Typ",
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
     * @SWG\Delete(
     *   path="/activity-type/{id}",
     *   tags={"Activity Type"},
     *   summary="Delete Activity Typ",
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
     * @SWG\Delete(
     *   path="/activity-type/{id}/force",
     *   tags={"Activity Type"},
     *   summary="Force delete Activity Typ",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */


}
