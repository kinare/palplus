<?php

namespace App\Http\Controllers\Group;

use App\Group;
use App\Http\Controllers\BaseController;
use App\Http\Resources\GroupResource;
use App\Http\Resources\MemberResource;
use App\Members;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
     *   @SWG\Parameter(name="type_id",in="query",description="group type id",required=true,type="string"),
     *   @SWG\Parameter(name="name",in="query",description="Group Name",required=true,type="string"),
     *   @SWG\Parameter(name="description",in="query",description="Group Description",required=true,type="string"),
     *   @SWG\Parameter(name="avatar",in="query",description="avatar",required=true,type="string"),
     *   @SWG\Parameter(name="access_level",in="query",description="access level",required=true,type="string"),
     *   @SWG\Parameter(name="country",in="query",description="country",required=true,type="string"),
     *   @SWG\Parameter(name="currency",in="query",description="currency",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    public function store(Request $request)
    {
        try{
            $model = new $this->model();
            $data = $request->all();
            $model->fill($data);
            $model->created_by = $request->user()->id;
            $model->code = Str::random(60);
            $model->save();

            //make first member admin
            $member = new Members();
            $member->group_id = $model->id;
            $member->user_id = $request->user()->id;
            $member->is_admin = true;
            $member->modified_by = $request->user()->id;
            $member->save();
            return $this->response($model);
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }

    }

    /**
     * @SWG\Patch(
     *   path="/group/{id}",
     *   tags={"Group"},
     *   summary="Update Group",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="group id",required=true,type="string"),
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
     *   @SWG\Parameter(name="id",in="path",description="group id",required=true,type="string"),
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
     *   @SWG\Parameter(name="id",in="path",description="group id",required=true,type="string"),
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
     *   @SWG\Parameter(name="id",in="path",description="group id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Post(
     *   path="/group/join/{user_id}/{group_id}",
     *   tags={"Group"},
     *   summary="Join group",
     *  security={
     *     {"bearer": {}},
     *   },
     *  @SWG\Parameter(name="user_id",in="query",description="user id",required=true,type="string"),
     *  @SWG\Parameter(name="group_id",in="query",description="Group Id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    public function join(Request $request)
    {
        try{
            $request->validate([
                'user_id' => 'required',
                'group_id' => 'required'
            ]);

            $user = User::find($request->user_id);
            if (!$user)
                return response()->json([
                    'message' => 'Member Not found'
                ], 404);


            $group = Group::find($request->group_id);
            if (!$group)
                return response()->json([
                    'message' => 'Group Not found'
                ], 404);

            if ($group->access_level === 'private')
                return response()->json([
                    'message' => 'Sorry, This is a private group'
                ], 400);

            $member = new Members();
            $member->user_id = $user->id;
            $member->group_id = $group->id;
            $member->save();

            return response()->json([
                'message' => 'You joined '. $group->name . ' successfully'
            ], 200);
        }catch (Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @SWG\Post(
     *   path="/group/leave/{member_id}/{group_id}",
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
    public function leave(Request $request)
    {
        try{
            $request->validate([
                'member_id' => 'required',
                'group_id' => 'required'
            ]);

            $member = Members::find($request->member_id);
            if (!$member)
                return response()->json([
                    'message' => 'Member Not found'
                ], 404);


            $group = Group::find($request->group_id);
            if (!$group)
                return response()->json([
                    'message' => 'Group Not found'
                ], 404);

            if ($group->access_level === 'private')
                return response()->json([
                    'message' => 'Sorry, This is a private group pay your dues first'
                ], 400);

            $member->delete();
            return response()->json([
                'message' => 'You left '. $group->name . ' successfully'
            ], 200);

        }catch (Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @SWG\Post(
     *   path="/group/make-admin/{member_id}/{group_id}",
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
    public function makeAdmin(Request $request)
    {
        try{
            $request->validate([
                'member_id' => 'required',
                'group_id' => 'required'
            ]);

            $member = Members::where(['id' => $request->member_id, 'group_id' => $request->group_id])->first();
            if (!$member)
                return response()->json([
                    'message' => 'Member Not found'
                ], 404);

            $user =  Members::where(['user_id' => $request->user()->id, 'group_id' => $request->group_id])->first();
            if (!$user->is_admin)
                return response()->json([
                    'message' => 'Unauthorised'
                ], 404);


            $member->is_admin = true;
            $member->modified_by = $request->user()->id;
            $member->save();

            return response()->json([
                'message' =>  $member->user()->first()->name . ' is now an admin'
            ], 200);

        }catch (Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @SWG\Post(
     *   path="/group/revoke-admin/{member_id}/{group_id}",
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
    public function revokeAdmin(Request $request)
    {
        try{
            $request->validate([
                'member_id' => 'required',
                'group_id' => 'required'
            ]);

            $member = Members::where(['id' => $request->member_id, 'group_id' => $request->group_id])->first();
            if (!$member)
                return response()->json([
                    'message' => 'Member Not found'
                ], 404);

            $user =  Members::where(['user_id' => $request->user()->id, 'group_id' => $request->group_id])->first();
            if (!$user->is_admin)
                return response()->json([
                    'message' => 'Unauthorised'
                ], 404);

            $member->is_admin = false;
            $member->modified_by = $request->user()->id;
            $member->save();

            return response()->json([
                'message' =>  $member->user()->first()->name . ' is no longer an admin'
            ], 200);

        }catch (Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @SWG\Get(
     *   path="/group/members/{group_id}",
     *   tags={"Group"},
     *   summary="Group members",
     *  security={
     *     {"bearer": {}},
     *   },
     *  @SWG\Parameter(name="group_id",in="path",description="Group Id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function members($group_id)
    {
        try{
           $group = Group::find($group_id);
           return MemberResource::collection($group->members()->get());
        }catch (Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }





}
