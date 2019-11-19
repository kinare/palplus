<?php

namespace App\Http\Controllers\Group;

use App\GroupProject;
use App\Http\Controllers\BaseController;
use App\Http\Resources\GroupProjectResource;
use Illuminate\Http\Request;

class GroupProjectController extends BaseController
{
    public function __construct($model = GroupProject::class, $resource = GroupProjectResource::class)
    {
        parent::__construct($model, $resource);
    }

    /**
     * @SWG\Get(
     *   path="/project",
     *   tags={"Group Project"},
     *  security={
     *     {"bearer": {}},
     *   },
     *   summary="Retrieve Group project",
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */

    /**
     * @SWG\Post(
     *   path="/project",
     *   tags={"Group Project"},
     *   summary="Group Project",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="group_id",in="query",description="group_id",required=true,type="string"),
     *   @SWG\Parameter(name="name",in="query",description="name",required=true,type="string"),
     *   @SWG\Parameter(name="description",in="query",description="description",required=true,type="string"),
     *   @SWG\Parameter(name="estimated_cost",in="query",description="estimated_cost",required=true,type="number"),
     *   @SWG\Parameter(name="actual_cost",in="query",description="actual_cost",required=true,type="number"),
     *   @SWG\Parameter(name="start_date",in="query",description="start_date",required=true,type="string"),
     *   @SWG\Parameter(name="end_date",in="query",description="end_date",required=true,type="string"),
     *   @SWG\Parameter(name="location",in="query",description="location",required=true,type="string"),
     *   @SWG\Parameter(name="allow_contributions",in="query",description="allow_contributions",required=true,type="integer"),
     *   @SWG\Parameter(name="contribution_amount",in="query",description="contribution_amount",required=false,type="number"),
     *   @SWG\Parameter(name="contribution_frequency",in="query",description="contribution_frequency",required=false,type="string"),
     *   @SWG\Parameter(name="enable_reminders",in="query",description="enable_reminders",required=false,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */

    /**
     * @SWG\Patch(
     *   path="/project/{id}",
     *   tags={"Group Project"},
     *   summary="Update Group Project",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Project id",required=true,type="string"),
     *   @SWG\Parameter(name="group_id",in="query",description="group_id",required=true,type="string"),
     *   @SWG\Parameter(name="name",in="query",description="name",required=true,type="string"),
     *   @SWG\Parameter(name="description",in="query",description="description",required=true,type="string"),
     *   @SWG\Parameter(name="estimated_cost",in="query",description="estimated_cost",required=true,type="number"),
     *   @SWG\Parameter(name="actual_cost",in="query",description="actual_cost",required=true,type="number"),
     *   @SWG\Parameter(name="start_date",in="query",description="start_date",required=true,type="string"),
     *   @SWG\Parameter(name="end_date",in="query",description="end_date",required=true,type="string"),
     *   @SWG\Parameter(name="location",in="query",description="location",required=true,type="string"),
     *   @SWG\Parameter(name="allow_contributions",in="query",description="allow_contributions",required=true,type="integer"),
     *   @SWG\Parameter(name="contribution_amount",in="query",description="contribution_amount",required=false,type="number"),
     *   @SWG\Parameter(name="contribution_frequency",in="query",description="contribution_frequency",required=false,type="string"),
     *   @SWG\Parameter(name="enable_reminders",in="query",description="enable_reminders",required=false,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Get(
     *   path="/project/{id}",
     *   tags={"Group Project"},
     *   summary="Retrieve Group Project",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Project id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/project/{id}",
     *   tags={"Group Project"},
     *   summary="Delete Group Project",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Project id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/project/{id}/force",
     *   tags={"Group Project"},
     *   summary="Force delete Group Project",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Project id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */




}






