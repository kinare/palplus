<?php

namespace App\Http\Controllers\Group;

use App\ActivityMembers;
use App\Contribution;
use App\ContributionType;
use App\GroupActivity;
use App\Http\Controllers\AccountingController;
use App\Http\Controllers\BaseController;
use App\Http\Resources\ContributionTypeResource;
use App\Http\Resources\GroupActivityResource;
use App\Http\Resources\MemberResource;
use App\Members;
use App\Transaction;
use App\User;
use App\Wallet;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravolt\Avatar\Facade as Avatar;

class GroupActivityController extends BaseController
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
     *   produces={"application/json"},
     *   consumes={"multipart/form-data"},
     *   security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="group_id",in="formData",description="Group id",required=true,type="string"),
     *   @SWG\Parameter(name="activity_type_id",in="formData",description="Activity type id",required=true,type="string"),
     *   @SWG\Parameter(name="name",in="formData",description="name",required=true,type="string"),
     *   @SWG\Parameter(name="description",in="formData",description="description",required=true,type="string"),
     *   @SWG\Parameter(name="avatar",in="formData",description="avatar",required=false,type="file"),
     *   @SWG\Parameter(name="itinerary",in="formData",description="itinerary",required=false,type="string"),
     *   @SWG\Parameter(name="start_date",in="formData",description="start date",required=true,type="string"),
     *   @SWG\Parameter(name="end_date",in="formData",description="end date",required=true,type="string"),
     *   @SWG\Parameter(name="cut_off_date",in="formData",description="cut off date",required=false,type="string"),
     *   @SWG\Parameter(name="contacts",in="formData",description="contacts",required=false,type="string"),
     *   @SWG\Parameter(name="slots",in="formData",description="slots",required=false,type="integer"),
     *   @SWG\Parameter(name="has_contributions",in="formData",description="has_contributions",required=false,type="integer"),
     *   @SWG\Parameter(name="featured",in="formData",description="featured",required=false,type="integer"),
     *   @SWG\Parameter(name="booking_fee",in="formData",description="booking fee",required=false,type="integer"),
     *   @SWG\Parameter(name="installments",in="formData",description="installments",required=false,type="integer"),
     *   @SWG\Parameter(name="no_of_installments",in="formData",description="no_of_installments",required=false,type="integer"),
     *   @SWG\Parameter(name="booking_fee_amount",in="formData",description="booking_fee_amount",required=false,type="number"),
     *   @SWG\Parameter(name="instalment_amount",in="formData",description="instalment_amount",required=false,type="number"),
     *   @SWG\Parameter(name="total_cost",in="formData",description="total_cost",required=false,type="number"),
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
            $model->save();

            if ($request->hasFile('avatar')){
                $attachment = [];
                $attachment['file'] = $request->file('avatar');
                $attachment['filename'] = $request->file('avatar')->getClientOriginalName();

                if (Storage::disk('avatars')->exists("activities/" . $model->id . '/' . $attachment['filename']))
                    $attachment['filename'] = uniqid().'.'.$attachment['file']->getClientOriginalExtension();

                Storage::disk('avatars')->put("activities/".$model->id.'/'.$attachment['filename'], file_get_contents($attachment['file']));
                $model->avatar = $attachment['filename'];
            }else{
                $avatar = Avatar::create($model->name)->getImageObject()->encode('png');
                Storage::disk('avatars')->put("activities/".$model->id.'/avatar.png', (string) $avatar);
                $model->avatar =  'avatar.png';
            }

            $model->save();
            return $this->response($model);
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }

    }

    /**
     * @SWG\Patch(
     *   path="/activity/{id}",
     *   tags={"Activity"},
     *   summary="Update Activity",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Activity id",required=true,type="string"),
     *   @SWG\Parameter(name="group_id",in="formData",description="Group id",required=true,type="string"),
     *   @SWG\Parameter(name="activity_type_id",in="formData",description="Activity type id",required=true,type="string"),
     *   @SWG\Parameter(name="name",in="formData",description="name",required=true,type="string"),
     *   @SWG\Parameter(name="description",in="formData",description="description",required=true,type="string"),
     *   @SWG\Parameter(name="avatar",in="formData",description="avatar",required=false,type="file"),
     *   @SWG\Parameter(name="itinerary",in="formData",description="itinerary",required=false,type="string"),
     *   @SWG\Parameter(name="start_date",in="formData",description="start date",required=true,type="string"),
     *   @SWG\Parameter(name="end_date",in="formData",description="end date",required=true,type="string"),
     *   @SWG\Parameter(name="cut_off_date",in="formData",description="cut off date",required=false,type="string"),
     *   @SWG\Parameter(name="contacts",in="formData",description="contacts",required=false,type="string"),
     *   @SWG\Parameter(name="slots",in="formData",description="slots",required=false,type="integer"),
     *   @SWG\Parameter(name="has_contributions",in="formData",description="has_contributions",required=false,type="integer"),
     *   @SWG\Parameter(name="featured",in="formData",description="featured",required=false,type="integer"),
     *   @SWG\Parameter(name="booking_fee",in="formData",description="booking fee",required=false,type="integer"),
     *   @SWG\Parameter(name="installments",in="formData",description="installments",required=false,type="integer"),
     *   @SWG\Parameter(name="no_of_installments",in="formData",description="no_of_installments",required=false,type="integer"),
     *   @SWG\Parameter(name="booking_fee_amount",in="formData",description="booking_fee_amount",required=false,type="number"),
     *   @SWG\Parameter(name="instalment_amount",in="formData",description="instalment_amount",required=false,type="number"),
     *   @SWG\Parameter(name="total_cost",in="formData",description="total_cost",required=false,type="number"),
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
     *   @SWG\Parameter(name="id",in="path",description="activity id",required=true,type="string"),
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
     *   @SWG\Parameter(name="id",in="path",description="activity id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/activity/{id}/force",
     *   tags={"Activity"},
     *   summary="Force delete Activity",
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
     * @SWG\Get(
     *   path="/activity/contributions/{activity_id}",
     *   tags={"Activity"},
     *   summary="Retrieve Activity contribution types",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="activity_id",in="path",description="activity id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function activityContributionTypes(Request $request, $activity_id){
        try{
            return ContributionTypeResource::collection(ContributionType::where('activity_id', $activity_id )->get());
        }catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ],500);
        }
    }

    /**
     * @SWG\Post(
     *   path="/activity/join",
     *   tags={"Activity"},
     *   summary="Join activity",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="member_id",in="query",description="member id",required=true,type="integer"),
     *   @SWG\Parameter(name="activity_id",in="query",description="activity id",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function join(Request $request){
        try{
            $request->validate([
                'member_id' => 'required',
                'activity_id' => 'required',
            ]);

            $activity = GroupActivity::find($request->activity_id);

            if ($activity->isMember($request->member_id))
                return response()->json([
                    'message' => 'You are already a member in this activity'
                ], 500);

            if (!$activity->canJoin())
                return response()->json([
                    'message' => 'Sorry, Joining period expired'
                ], 500);

            if (!$activity->hasSlots())
                return response()->json([
                    'message' => 'Sorry, no slot available'
                ], 500);

            $actMember = new ActivityMembers();
            $actMember->group_id = $activity->group_id;
            $actMember->member_id = Members::member($activity->group_id)->id;
            $actMember->activity_id = $activity->id;
            $actMember->status = $activity->booking_fee ? 'inactive' : 'active';
            $actMember->save();

            return response()->json([
                'message' => 'Succesfully joined '.$activity->name
            ], 200);
        }catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ],500);
        }


    }

    /**
     * @SWG\Post(
     *   path="/activity/leave",
     *   tags={"Activity"},
     *   summary="Leave activity",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="member_id",in="query",description="member id",required=true,type="integer"),
     *   @SWG\Parameter(name="activity_id",in="query",description="activity id",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function leave(Request $request){
        try{
            $request->validate([
                'member_id' => 'required',
                'activity_id' => 'required',
            ]);

            $activity = GroupActivity::find($request->activity_id);

            if (!$activity->isMember($request->member_id))
                return response()->json([
                    'message' => 'You are not a member in this activity'
                ], 500);

            $member = ActivityMembers::where('member_id', $request->member_id)->first();
            $member->forceDelete();

            return response()->json([
                'message' => 'You have successfully left '.$activity->name
            ], 200);

        }catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ],500);
        }
    }

    /**
     * @SWG\Post(
     *   path="/activity/pay",
     *   tags={"Activity"},
     *   summary="Pay for activity",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="member_id",in="query",description="member id",required=true,type="integer"),
     *   @SWG\Parameter(name="contribution_type_id",in="query",description="contribution type id",required=true,type="integer"),
     *   @SWG\Parameter(name="amount",in="query",description="amount",required=true,type="number"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function pay(Request $request){
        try{
            $request->validate([
                'member_id' => 'required',
                'contribution_type_id' => 'required',
                'amount' => 'required',
            ]);

            $myWallet = Wallet::where('user_id',$request->user()->id )->first();
            $groupWallet = Wallet::where('group_id',Members::find($request->member_id)->group_id)->first();

            if (!$myWallet->canWithdraw($request->amount))
                return response()->json([
                    'message' => 'Insufficient Funds'
                ], 200);

            AccountingController::transact($myWallet, $groupWallet, $request->amount);

            if (ContributionType::find($request->contribution_type_id)->booking_fee){
                $member = ActivityMembers::where('member_id', $request->member_id)->first();
                $member->status = 'active';
                $member->save();
            }

            return response()->json([
                'message' => 'Transaction successful'
            ], 200);

        }catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ],500);
        }
    }

    /**
     * @SWG\Get(
     *   path="/activity/members/{activity_id}",
     *   tags={"Activity"},
     *   summary="Activity Members",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="activity_id",in="path",description="activity id",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function members($activity_id){
        try{

            $actMembers = ActivityMembers::where('activity_id', $activity_id)->get();
            $members = [];

            foreach ($actMembers as $actMember){
                array_push($members, $actMember->member_id);
            }

            return MemberResource::collection(Members::whereIn('id', $members)->get());
        }catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ],500);
        }
    }

}
