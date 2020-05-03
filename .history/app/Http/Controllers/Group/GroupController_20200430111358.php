<?php

namespace App\Http\Controllers\Group;

use App\Contribution;
use App\ContributionType;
use App\Currency;
use App\Group;
use App\GroupActivity;
use App\GroupProject;
use App\GroupSetting;
use App\GroupSetup;
use App\GroupType;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Currency\Converter;
use App\Http\Controllers\Finance\Transaction;
use App\Http\Resources\ContributionResource;
use App\Http\Resources\ContributionTypeResource;
use App\Http\Resources\GroupActivityResource;
use App\Http\Resources\GroupProjectResource;
use App\Http\Resources\GroupResource;
use App\Http\Resources\GroupSettingResource;
use App\Http\Resources\LoanSettingResource;
use App\Http\Resources\MemberResource;
use App\Http\Resources\PaymentResource;
use App\Http\Resources\WalletResource;
use App\Http\Resources\WithdrawalResource;
use App\Http\Resources\WithdrawalSettingResource;
use App\LoanSetting;
use App\Members;
use App\Payment;
use App\Wallet;
use App\Withdrawal;
use App\WithdrawalSetting;
use Auth;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravolt\Avatar\Facade as Avatar;
use function MongoDB\BSON\toPHP;

class GroupController extends BaseController
{
 public function __construct()
 {
     $this->middleware("auth:api");
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
    public function index()
    {
        try{
            return $this->response($this->model::where('access_level', 'public')->orderBy('id', 'DESC')->get());
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }

    }

    /**
     * @SWG\Post(
     *  path="/group",
     *  tags={"Group"},
     *  summary="Create Group",
     *  produces={"application/json"},
     *  consumes={"multipart/form-data"},
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="type_id",in="formData",description="group type id",required=true,type="string"),
     *   @SWG\Parameter(name="name",in="formData",description="Group Name",required=true,type="string"),
     *   @SWG\Parameter(name="description",in="formData",description="Group Description",required=true,type="string"),
     *   @SWG\Parameter(name="avatar",in="formData",description="avatar",required=false,type="file"),
     *   @SWG\Parameter(name="access_level",in="formData",description="access level",required=true,type="string"),
     *   @SWG\Parameter(name="country",in="formData",description="country",required=true,type="string"),
     *   @SWG\Parameter(name="currency_id",in="formData",description="currency id",required=true,type="integer"),
     *   @SWG\Parameter(name="contribution_categories_id",in="formData",description="contribution_categories_id",required=false,type="integer"),
     *   @SWG\Parameter(name="contribution_target_amount",in="formData",description="contribution_target_amount",required=false,type="number"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function store(Request $request)
    {
        try{
            /* check setup fee*/
            $setup = GroupSetup::first();

			$wallet = Wallet::mine();
			
			// if(!$wallet) {
			// 	// dd($wallet);
			// 	$wallet = Wallet::make('Group', false, $request->user()->id, $request->currency_id);
			// }
			$amount = $this->beforeCreate($wallet->currencyShortDesc())['data']['amount'];
			// dd($amount);
            if (!$wallet->canWithdraw($amount)){
				return response()->json([
					'message' => 'Insufficient funds'
                ], 200);
            }

            $model = new $this->model();
            $data = $request->all();
            $model->fill($data);
            $model->created_by = $request->user()->id;
            $model->code = Str::random(40).Carbon::now()->timestamp;

            if ($request->hasFile('avatar')){
                $attachment = [];
                $attachment['file'] = $request->file('avatar');
                $attachment['filename'] = $request->file('avatar')->getClientOriginalName();

                if (Storage::exists("groups/" . $model->code . '/' . $attachment['filename']))
                    $attachment['filename'] = uniqid().'.'.$attachment['file']->getClientOriginalExtension();

                Storage::disk('avatars')->put("groups/".$model->code.'/'.$attachment['filename'], file_get_contents($attachment['file']));
                $model->avatar = $attachment['filename'];
            }else{
                $avatar = Avatar::create($model->name)->getImageObject()->encode('png');
                Storage::disk('avatars')->put("groups/".$model->code.'/avatar.png', (string) $avatar);
                $model->avatar =  'avatar.png';
            }

            $model->save();

            //init group settings
            GroupSettingController::init($request, $model->id);

            //make first member admin
            $member = new Members();
            $member->group_id = $model->id;
            $member->user_id = $request->user()->id;
            $member->is_admin = true;
            $member->loan_approver = true;
            $member->withdrawal_approver = true;
            $member->created_by = $request->user()->id;
            $member->save();

            /* transact to group wallet */
            $transaction = new Transaction();
            $transaction->transact(
                $wallet,
                Wallet::group($model->id),
                $amount,
                'Group Setup Fee',
                'Initial group setup fee'
            );

            return $this->response($model);
        }catch (Exception $exception){
            return response()->json([
               'message' => "Error"
           ]);
        }

    }

    /**
     * @SWG\Post(
     *   path="/group/{id}",
     *   tags={"Group"},
     *   summary="Update Group",
     *  produces={"application/json"},
     *  consumes={"multipart/form-data"},
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="group id",required=true,type="string"),
     *   @SWG\Parameter(name="name",in="formData",description="Group Name",required=true,type="string"),
     *   @SWG\Parameter(name="description",in="formData",description="Group Description",required=true,type="string"),
     *   @SWG\Parameter(name="access_level",in="formData",description="access level",required=true,type="string"),
     *   @SWG\Parameter(name="avatar",in="formData",description="avatar",required=false,type="file"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function update(Request $request, $id)
    {
        try{
            $model = $this->model::find($id);
            $model->fill($request->all());
            $model->modified_by = $request->user()->id;
            if ($request->hasFile('avatar')){
                $attachment = [];
                $attachment['file'] = $request->file('avatar');
                $attachment['filename'] = $request->file('avatar')->getClientOriginalName();

                if (Storage::exists("groups/" . $model->code . '/' . $attachment['filename']))
                    $attachment['filename'] = uniqid().'.'.$attachment['file']->getClientOriginalExtension();

                Storage::disk('avatars')->put("groups/".$model->code.'/'.$attachment['filename'], file_get_contents($attachment['file']));
                $model->avatar = $attachment['filename'];
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
     * @SWG\Get(
     *   path="/group/type/{type_id}",
     *   tags={"Group"},
     *   summary="Retrieve Group by type",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="type_id",in="path",description="group type id",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     * @param $type_id
     * @return AnonymousResourceCollection
     */
    public function byType($type_id){
        return GroupResource::collection(Group::where('type_id', $type_id)->get());
    }

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
     * @SWG\Get(
     *   path="/group/validate/{member_id}",
     *   tags={"Group"},
     *   summary="Validate Member",
     *  security={
     *     {"bearer": {}},
     *   },
     *  @SWG\Parameter(name="member_id",in="path",description="Member Id",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function validateMember($member_id)
    {
        try{
            $member = Members::find($member_id);
            $settings = GroupSetting::whereGroupId($member->group_id)->first();

            if ($member->active)
                return response()->json([
                    'validated' => 1
                ], 200);

            if ($settings->membership_fee)
                return response()->json([
                    'validated' => 0
                ], 200);

            $member->active = true;
            $member->save();

            return response()->json([
                'validated' => 1
            ], 200);

        }catch (Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @SWG\Post(
     *   path="/group/join",
     *   tags={"Group"},
     *   summary="Join group",
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
    public function join(Request $request)
    {
        try{
            $request->validate([
                'group_id' => 'required'
            ]);

            $member = Members::where(['user_id' => $request->user()->id, 'group_id' => $request->group_id])->first();
            if ($member)
                return response()->json([
                    'message' => 'You are already a member'
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
            $member->user_id = $request->user()->id;
            $member->group_id = $group->id;
            $member->save();

            return new MemberResource($member);
        }catch (Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @SWG\Get(
     *   path="/group/leave-request/{group_id}",
     *   tags={"Group"},
     *   summary="Leave group request",
     *  security={
     *     {"bearer": {}},
     *   },
     *  @SWG\Parameter(name="group_id",in="path",description="Group Id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function leaveRequest($group_id){
        try{
            return [
              'data' => Group::leaveStatus(Members::member($group_id))
            ];
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    /**
     * @SWG\Post(
     *   path="/group/leave",
     *   tags={"Group"},
     *   summary="Leave group",
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
    public function leave(Request $request)
    {
        try{
            $request->validate([
                'group_id' => 'required'
            ]);

            $member = Members::member($request->group_id);
            if (!$member)
                return response()->json([
                    'message' => 'You are not a member in this group'
                ], 404);


            $group = Group::find($request->group_id);
            if (!$group)
                return response()->json([
                    'message' => 'Group Not found'
                ], 404);

            $type = GroupType::find($group->type_id);

            /* leave direct for fundraising */
            if ($type->type === 'Tours-and-travel' || $type->type === 'Fundraising'){
                $member->forceDelete();
                return response()->json([
                    'message' => 'You left '. $group->name . ' successfully'
                ], 200);
            }

            /*validate leave request*/
            $arrears = Group::leaveStatus($member);


            if ($arrears['loan_balance'] > 0)
                return response()->json([
                    'message' => 'You have an outstanding loan balance of '.$arrears['loan_balance'].' Clear the loan first'
                ], 401);


            /* create leave group fee pending payment*/
            if ($arrears['leaveGroupFee'] > 0){
                Payment::init([
                    'user_id' => $member->user_id,
                    'group_id' => $member->group_id,
                    'description' => 'Leaving Group fee',
                    'model' => Members::class,
                    'model_id' => $member->id,
                    'transaction_code' =>'',
                    'amount' =>  $arrears['leaveGroupFee'],
                ]);
            }

            /* create withdrawal request for member */
            if (($arrears['total_contributions'] - $arrears['total_withdrawals']) > 0){
                Withdrawal::withdraw($member,  $arrears['total_contributions'] - $arrears['total_withdrawals']);
            }

            /* if total withdrawable is zero leave group */
            if(($arrears['total_withdrawable'] - $arrears['leaveGroupFee']) === 0) {
                $member->forceDelete();
                return response()->json([
                    'message' => 'You left '. $group->name . ' successfully'
                ], 200);
            }

            return response()->json([
                'message' => 'Request received successfully, withdrawable amount is being processed. also clear your pending payments'
            ], 400);

        }catch (Exception $e){
            return $e;

//            response()->json([
//                'message' => $e
//            ], 500);
        }
    }

    /**
     * @SWG\Post(
     *   path="/group/make-admin",
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
     *   path="/group/revoke-admin",
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
     * @SWG\Post(
     *   path="/group/make-approver",
     *   tags={"Group"},
     *   summary="Make Member an approver",
     *  security={
     *     {"bearer": {}},
     *   },
     *  @SWG\Parameter(name="member_id",in="query",description="Member_id",required=true,type="string"),
     *  @SWG\Parameter(name="group_id",in="query",description="Group Id",required=true,type="string"),
     *  @SWG\Parameter(name="approver_type",in="query",description="Approver type i.e LOAN, WITHDRAWAL",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function makeApprover(Request $request){
        try{

            $request->validate([
                'member_id' => 'required',
                'group_id' => 'required',
                'approver_type' => 'required'
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

            if ($request->approver_type === 'LOAN'){
                $member->loan_approver = true;
            }

            if ($request->approver_type === 'WITHDRAWAL'){
                $member->withdrawal_approver = true;
            }

            $member->modified_by = $request->user()->id;
            $member->save();

            return response()->json([
                'message' =>  $member->user()->first()->name . ' is a group '.mb_strtolower($request->approver_type).' approver'
            ], 200);

        }catch (Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @SWG\Post(
     *   path="/group/revoke-approver",
     *   tags={"Group"},
     *   summary="Revoke Member approver",
     *  security={
     *     {"bearer": {}},
     *   },
     *  @SWG\Parameter(name="member_id",in="query",description="Member_id",required=true,type="string"),
     *  @SWG\Parameter(name="group_id",in="query",description="Group Id",required=true,type="string"),
     *  @SWG\Parameter(name="approver_type",in="query",description="Approver type i.e LOAN, WITHDRAWAL",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function revokeApprover(Request $request){
        try{
            $request->validate([
                'member_id' => 'required',
                'group_id' => 'required',
                'approver_type' => 'required'
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

            if ($request->approver_type === 'LOAN'){
                $member->loan_approver = false;
            }

            if ($request->approver_type === 'WITHDRAWAL'){
                $member->withdrawal_approver = false;
            }

            $member->modified_by = $request->user()->id;
            $member->save();

            return response()->json([
                'message' =>  $member->user()->first()->name . ' is no longer a '.mb_strtolower($request->approver_type).' approver'
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

    /**
     * @SWG\Get(
     *   path="/group/approvers/{group_id}/{approver_type}",
     *   tags={"Group"},
     *   summary="Group Approvers",
     *  security={
     *     {"bearer": {}},
     *   },
     *  @SWG\Parameter(name="group_id",in="path",description="Group Id",required=true,type="string"),
     *  @SWG\Parameter(name="approver_type",in="path",description="Approver type i.e LOAN, WITHDRAWAL",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function approvers($group_id, $approver_type)
    {
        try{

            if ($approver_type === 'LOAN'){
                return MemberResource::collection(Members::where([
                    'loan_approver' => true,
                    'group_id' => $group_id,
                    ])->get());
            }

            if ($approver_type === 'WITHDRAWAL'){
                return MemberResource::collection(Members::where([
                    'withdrawal_approver' => true,
                    'group_id' => $group_id,
                ])->get());
            }

        }catch (Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }



    /**
 * @SWG\Get(
 *   path="/group/admins/{group_id}",
 *   tags={"Group"},
 *   summary="Group admins",
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
    public function admins($group_id)
    {
        try{
            $group = Group::find($group_id);
            return MemberResource::collection($group->members()->where('is_admin', true)->get());
        }catch (Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @SWG\Get(
     *   path="/group/contriburions/{group_id}",
     *   tags={"Group"},
     *   summary="Group Contriburions",
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
    public function contriburions($group_id)
    {
        try{
            return ContributionResource::collection(Contribution::where('group_id', $group_id)->get());
        }catch (Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @SWG\Get(
     *   path="/group/wallet/{group_id}",
     *   tags={"Group"},
     *   summary="Group Wallet",
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
    public function wallet($group_id)
    {
        try{
            return new WalletResource(Wallet::where('group_id', $group_id)->first());
        }catch (Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @SWG\Get(
     *   path="/group/me/{group_id}",
     *   tags={"Group"},
     *   summary="Current Member",
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
    public function me(Request $request, $group_id)
    {
        try{
            $me = Members::where(['user_id' => $request->user()->id, 'group_id' => $group_id])->first();

            if (!$me)
                return response()->json([
                    'message' => 'You are not in any group.'
                ], 404);

            return new MemberResource($me);
        }catch (Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @SWG\Get(
     *   path="/group/settings/{group_id}",
     *   tags={"Group"},
     *   summary="Group Membership settings",
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
    public function settings(Request $request, $group_id)
    {
        try{
            return new GroupSettingResource(GroupSetting::where(['group_id' => $group_id])->first());
        }catch (Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @SWG\Get(
     *   path="/group/projects/{group_id}",
     *   tags={"Group"},
     *   summary="Group Projects",
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
    public function projects(Request $request, $group_id)
    {
        try{
            return GroupProjectResource::collection(GroupProject::where(['group_id' => $group_id])->get());
        }catch (Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @SWG\Get(
     *   path="/group/activities/{group_id}",
     *   tags={"Group"},
     *   summary="Activity by group",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="group_id",in="path",description="group id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function activities($group_id)
    {
        try{
            return GroupActivityResource::collection(GroupActivity::where('group_id', $group_id )->get());
        }catch (Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ],500);
        }
    }

    /**
     * @SWG\Get(
     *   path="/group/loan-settings/{group_id}",
     *   tags={"Group"},
     *   summary="Loan by group",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="group_id",in="path",description="group id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function loanSettings($group_id)
    {
        try{
            return LoanSettingResource::collection(LoanSetting::where('group_id', $group_id )->get());
        }catch (Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ],500);
        }
    }

    /**
     * @SWG\Get(
     *   path="/group/withdrawal-settings/{group_id}",
     *   tags={"Group"},
     *   summary="Withdrawal setting by group",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="group_id",in="path",description="group id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function withdrawalSettings($group_id)
    {
        try{
            return WithdrawalSettingResource::collection(WithdrawalSetting::where('group_id', $group_id )->get());
        }catch (Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ],500);
        }
    }

    /**
     * @SWG\Get(
     *   path="/group/withdrawals/{group_id}",
     *   tags={"Group"},
     *   summary="Withdrawals for group",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="group_id",in="path",description="group id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function withdrawals($group_id)
    {
        try{
            return WithdrawalResource::collection(Withdrawal::where('group_id', $group_id )->get());
        }catch (Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ],500);
        }
    }

    /**
     * @SWG\Get(
     *   path="/group/pending-payments/{group_id}",
     *   tags={"Group"},
     *   summary="Group Pending Payments",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="group_id",in="path",description="group id",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function pendingPayments($group_id)
    {
        try{
            return PaymentResource::collection(Payment::where('group_id', $group_id )->get());
        }catch (Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ],500);
        }
    }

    /**
     * @SWG\Get(
     *   path="/group/my-payments/{group_id}",
     *   tags={"Group"},
     *   summary="Group Pending Payments",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="group_id",in="path",description="group id",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function myPendingPayments($group_id)
    {
        try{
            return PaymentResource::collection(Payment::where(['group_id' => $group_id, 'user_id' => Auth::user()->id] )->get());
        }catch (Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ],500);
        }
    }

    /**
     * @SWG\Get(
     *   path="/group/init-group/{currency}",
     *   tags={"Group"},
     *   summary="Initialize group",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="currency",in="path",description="group currency",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function beforeOmambia($currencyShortDesc){
		dd($currencyShortDesc);
		$setup = GroupSetup::all();
        $amount = Converter::Convert($setup->currency, $currencyShortDesc, $setup->amount);

        return [
            'data' => [
                'amount' => $amount['amount'],
                'description' => $setup->description
            ]
        ];
	}
	
	public function beforeCreate($currencyShortDesc){
		$setup = GroupSetup::first();
		// dd($setup->amount);
        $amount = Converter::Convert($setup->currency, $currencyShortDesc, $setup->amount);
        return [
            'data' => [
                'amount' => $amount['amount'],
                'description' => $setup->description
            ]
        ];
	}
}
