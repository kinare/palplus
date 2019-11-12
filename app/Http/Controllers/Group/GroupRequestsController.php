<?php

namespace App\Http\Controllers\Group;

use App\GroupRequests;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\MembersController;
use App\Http\Resources\GroupRequestResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GroupRequestsController extends BaseController
{
   public function __construct($model = GroupRequests::class, $resource = GroupRequestResource::class)
   {
       parent::__construct($model, $resource);
   }

    /**
     * @SWG\Get(
     *   path="/group-request",
     *   tags={"Group Request"},
     *   summary="all requests",
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
     *   path="/group-request/join",
     *   tags={"Group Request"},
     *   summary="Request to join group",
     *  security={
     *     {"bearer": {}},
     *   },
     *  @SWG\Parameter(name="group_id",in="query",description="Group Id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
   public function request(Request $request)
   {
       try{
            $request->validate([
                'group_id' => 'required',
            ]);

            $myRequest = new GroupRequests();
            $myRequest->fill($request->all());
            $myRequest->user_id = $request->user()->id;
            $myRequest->request_code = Str::random(60).Carbon::now()->timestamp;
            $myRequest->created_by = $request->user()->id;
            $myRequest->save();

            return response()->json([
                'message' => 'Your request has been placed successfully'
            ], 200);


       }catch (\Exception $e){
           return response()->json([
               'message' => $e->getMessage()
           ],500);
       }
   }

    /**
     * @SWG\Post(
     *   path="/group-request/approve",
     *   tags={"Group Request"},
     *   summary="Approve Group Join Request",
     *  security={
     *     {"bearer": {}},
     *   },
     *  @SWG\Parameter(name="request_code",in="query",description="request_code",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function approve(Request $request)
    {
        try{
            $request->validate([
                'request_code' => 'required'
            ]);

            $theRequest = GroupRequests::where('request_code', $request->request_code)->first();

            if (!MembersController::isAdmin($theRequest->group_id)){
                return response()->json([
                    'message' => 'Unauthorized'
                ], 401);
            }

            $data = [
                'group_id' => $theRequest->group_id,
                'user_id' => $theRequest->user_id
            ];

            //create member
            MembersController::member($data);

            $theRequest->status = 'approved';
            $theRequest->save();

            return response()->json([
                'message' => 'Request approved successfully'
            ], 200);


        }catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ],500);
        }
    }

    /**
     * @SWG\Post(
     *   path="/group-request/decline",
     *   tags={"Group Request"},
     *   summary="Decline Group Join Request",
     *  security={
     *     {"bearer": {}},
     *   },
     *  @SWG\Parameter(name="request_code",in="query",description="request_code",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function decline(Request $request)
    {
        try{
            $request->validate([
                'request_code' => 'required'
            ]);

            $theRequest = GroupRequests::where('request_code', $request->request_code)->first();

            if (!MembersController::isAdmin($theRequest->group_id)){
                return response()->json([
                    'message' => 'Unauthorized'
                ], 401);
            }

            $theRequest->status = 'declined';
            $theRequest->save();

            return response()->json([
                'message' => 'Request declined successfully'
            ], 200);

        }catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ],500);
        }
    }
}
