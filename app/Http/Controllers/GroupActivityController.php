<?php

namespace App\Http\Controllers;

use App\GroupActivity;
use App\Http\Resources\GroupActivityResource;
use Illuminate\Http\Request;

class GroupActivityController extends Controller
{
    public function __construct()
    {
        parent::__construct(GroupActivity::class, GroupActivityResource::class);
    }
    /**
     * @SWG\Get(
     *   path="/activity",
     *   tags={"Activity"},
     *   summary="Retrieve Activity",
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
     *   path="/activity",
     *   tags={"Activity"},
     *   summary="Create Activity",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="group_id",in="query",description="Group id",required=true,type="string"),
     *   @SWG\Parameter(name="activity_type_id",in="query",description="Activity type id",required=true,type="string"),
     *   @SWG\Parameter(name="description",in="query",description="description",required=true,type="string"),
     *   @SWG\Parameter(name="start_date",in="query",description="start date",required=true,type="string"),
     *   @SWG\Parameter(name="end_date",in="query",description="end date",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */


    /**
     * @SWG\Patch(
     *   path="/activity/{id}",
     *   tags={"Activity"},
     *   summary="Update Activity",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="activity_type_id",in="query",description="Activity type id",required=true,type="string"),
     *   @SWG\Parameter(name="description",in="query",description="description",required=true,type="string"),
     *   @SWG\Parameter(name="start_date",in="query",description="start date",required=true,type="string"),
     *   @SWG\Parameter(name="end_date",in="query",description="end date",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Get(
     *   path="/activity/{id}",
     *   tags={"Activity"},
     *   summary="Retrieve Activity",
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
     *   path="/activity/{id}",
     *   tags={"Activity"},
     *   summary="Delete Activity",
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
     *   path="/activity/{id}/force",
     *   tags={"Activity Type"},
     *   summary="Force delete Activity",
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
