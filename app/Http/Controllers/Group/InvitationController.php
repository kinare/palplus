<?php

namespace App\Http\Controllers\Group;

use App\Gender;
use App\Group;
use App\Http\Controllers\BaseController;
use App\Http\Resources\InvitationResource;
use App\Http\Resources\MemberResource;
use App\Invitation;
use App\Members;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InvitationController extends BaseController
{
   public function __construct($model = Invitation::class, $resource = InvitationResource::class)
   {
       parent::__construct($model, $resource);
   }

    /**
     * @SWG\Get(
     *   path="/invitation",
     *   tags={"Invitation"},
     *   summary="all invitations",
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
     *   path="/invitation/invite",
     *   tags={"Invitation"},
     *   summary="Invite user to a group",
     *  security={
     *     {"bearer": {}},
     *   },
     *  @SWG\Parameter(name="group_id",in="query",description="Group Id",required=true,type="string"),
     *  @SWG\Parameter(name="user_id",in="query",description="user Id",required=false,type="string"),
     *  @SWG\Parameter(name="phone",in="query",description="User phone number",required=false,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

   public function invite(Request $request)
   {
       try{
          $request->validate([
              'group_id' => 'required',
              'user_id' => 'required_without:phone',
              'phone' => 'required_without:user_id',
          ]);

          $admin = Members::where(['group_id' => $request->group_id, 'user_id' => $request->user()->id])->first();
          if (!$admin->is_admin){
              return response()->json([
                  'message' => 'Unauthorized'
              ], 401);
          }


          $data = $request->all();
          $phone = $data['phone'][0] === '0'  ? substr($data['phone'], 1) : $data['phone'];

          if(empty($request->user_id)){
              $user = User::where('phone', 'LIKE', '%'.$phone.'%')->first();
              if (!$user){
                  return response()->json([
                      'message' => 'no user found'
                  ], 404);
              }
              $data['user_id'] = $user->id;
          }

          $invitation = new $this->model();
          $invitation->fill($data);
          $invitation->invitation_code = Str::random(60).Carbon::now()->timestamp;
          $invitation->save();

          return response()->json([
              'message' => 'An invitation has been sent to the user'
          ], 200);

       }catch (\Exception $e){
           return response()->json([
               'message' => $e->getMessage()
           ],500);
       }
   }

    /**
     * @SWG\Post(
     *   path="/invitation/accept",
     *   tags={"Invitation"},
     *   summary="Accept group invitation",
     *  security={
     *     {"bearer": {}},
     *   },
     *  @SWG\Parameter(name="invitation_code",in="query",description="invitation_code",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
   public function accept(Request $request)
   {
       try{
            $request->validate([
                'invitation_code' => 'required'
            ]);
            $invitation =Invitation::where('invitation_code', $request->invitation_code)->first();

            //Joins group
           $member = new Members();
           $member->group_id = $invitation->group_id;
           $member->user_id = $invitation->user_id;
           $member->save();

           //delete invitation
           $invitation->status = 'accepted';
           $invitation->save();

           return new MemberResource($member);
       }catch (\Exception $e){
           return response()->json([
               'message' => $e->getMessage()
           ],500);
       }
   }

    /**
     * @SWG\Post(
     *   path="/invitation/decline",
     *   tags={"Invitation"},
     *   summary="Decline group invitation",
     *  security={
     *     {"bearer": {}},
     *   },
     *  @SWG\Parameter(name="invitation_code",in="query",description="invitation_code",required=true,type="string"),
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
                'invitation_code' => 'required'
            ]);
            $invitation = Invitation::where('invitation_code', $request->invitation_code)->first();

            $invitation->status = 'declined';
            $invitation->save();

            return response()->json([
                'message' => 'You have decline group invitation request'
            ], 200);

        }catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ],500);
        }
    }
}
