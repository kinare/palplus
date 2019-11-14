<?php

namespace App\Http\Controllers\Group;

use App\Approver;
use App\ApproverTypes;
use App\Contribution;
use App\Group;
use App\Http\Controllers\BaseController;
use App\Http\Resources\ApproverResourcce;
use App\Http\Resources\ContributionResource;
use App\Http\Resources\GroupResource;
use App\Http\Resources\MemberResource;
use App\Http\Resources\WalletResource;
use App\Members;
use App\User;
use App\Wallet;
use Exception;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravolt\Avatar\Facade as Avatar;

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

    public function index()
    {
        try{
            return $this->response($this->model::orderBy('id', 'DESC')->get());
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
     *   @SWG\Parameter(name="currency_id",in="formData",description="currency_id",required=true,type="integer"),
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

            //make first member admin
            $member = new Members();
            $member->group_id = $model->id;
            $member->user_id = $request->user()->id;
            $member->is_admin = true;
            $member->created_by = $request->user()->id;
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

            $member = Members::where(['user_id' => $request->user()->id, 'group_id' => $request->group_id]);
            if (!$member)
                return response()->json([
                    'message' => 'You are not a member in this group'
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

            $member->forceDelete();
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
                return MemberResource::collection(Members::where('loan_approver', true)->get());
            }

            if ($approver_type === 'WITHDRAWAL'){
                return MemberResource::collection(Members::where('withdrawal_approver', true)->get());
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
            return new WalletResource(Wallet::where('group_id', $group_id)->get());
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
            return new MemberResource(Members::where(['user_id' => $request->user()->id, 'group_id' => $group_id])->first());
        }catch (Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }





}
