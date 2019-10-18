<?php

namespace App\Http\Controllers;

use App\Http\Resources\MemberResource;
use App\Members;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MembersController extends BaseController
{
    public function __construct()
    {
        parent::__construct(Members::class, MemberResource::class);
    }


    /**
     * @SWG\Get(
     *   path="/member",
     *   tags={"Member"},
     *   summary="Retrieve list of members",
     *   security={
     *     {"passport": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */

    /**
     * @SWG\Post(
     *   path="/member",
     *   tags={"Member"},
     *   summary="Create New Member",
     *   security={
     *     {"passport": {}},
     *   },
     *   @SWG\Parameter(name="group_id",in="query",description="group id",required=true,type="integer"),
     *   @SWG\Parameter(name="user_id",in="query",description="user_id",required=true,type="integer"),
     *   @SWG\Parameter(name="setting_id",in="query",description="setting_id",required=true,type="integer"),
     *   @SWG\Parameter(name="profile_id",in="query",description="profile_id",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function store(Request $request)
    {
        $request->validate([d.
            'group_id' => 'required',
            'user_id'  => 'required',
            'setting_id'  => 'required',
            'profile_id'  => 'required'
        ]);

        return parent::store($request);
    }
}
