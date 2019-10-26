<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Resources\GroupResource;
use Exception;
use Illuminate\Http\Request;

class GroupController extends BaseController
{
 public function __construct()
 {
     parent::__construct(Group::class, GroupResource::class);
 }

    /**
     * @SWG\Get(
     *   path="/group",
     *   tags={"Group"},
     *   summary="Retrieve Groups",
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
     *   path="/group",
     *   tags={"Group"},
     *   summary="Create Group",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="name",in="query",description="Group Name",required=true,type="string"),
     *   @SWG\Parameter(name="description",in="query",description="Group Description",required=true,type="string"),
     *   @SWG\Parameter(name="access_level",in="query",description="access level",required=true,type="string"),
     *   @SWG\Parameter(name="country",in="query",description="country",required=true,type="string"),
     *   @SWG\Parameter(name="currency",in="query",description="currency",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Patch(
     *   path="/group/{id}",
     *   tags={"Group"},
     *   summary="Update Group",
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
     *   path="/group/{id}",
     *   tags={"Group"},
     *   summary="Retrieve Group",
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
     *   path="/group/{id}",
     *   tags={"Group"},
     *   summary="Delete Group",
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
     *   path="/group/{id}/force",
     *   tags={"Group"},
     *   summary="Force delete Group",
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
     *   path="/group/join/{member}/{group}",
     *   tags={"Group"},
     *   summary="Join group",
     *  security={
     *     {"bearer": {}},
     *   },
     *  @SWG\Parameter(name="member_id",in="query",description="Member_id",required=true,type="string"),
     *  @SWG\Parameter(name="group_id",in="query",description="Group Id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function join()
    {

    }

    /**
     * @SWG\Post(
     *   path="/group/leave/{member}/{group}",
     *   tags={"Group"},
     *   summary="Leave group",
     *  security={
     *     {"bearer": {}},
     *   },
     *  @SWG\Parameter(name="member_id",in="query",description="Member_id",required=true,type="string"),
     *  @SWG\Parameter(name="group_id",in="query",description="Group Id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function leave()
    {

    }





}
