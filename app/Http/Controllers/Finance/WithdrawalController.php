<?php

namespace App\Http\Controllers\Finance;

use App\Contribution;
use App\ContributionType;
use App\Group;
use App\GroupActivity;
use App\GroupProject;
use App\Http\Controllers\BaseController;
use App\Http\Resources\ContributionResource;
use App\Http\Resources\WithdrawalResource;
use App\Members;
use App\Wallet;
use App\Withdrawal;
use App\WithdrawalApprovalEntry;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\NotificationTypes;
use App\Notification;

class WithdrawalController extends BaseController
{
    public function __construct($model = Withdrawal::class, $resource = WithdrawalResource::class)
    {
        parent::__construct($model, $resource);
    }

    /**
     * @SWG\Get(
     *   path="/withdrawal/limit/{type}/{group_id}",
     *   tags={"Withdraw"},
     *   summary="withdrawal Limit",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="type",in="path",description="Type GROUP/PERSONAL",required=true,type="string"),
     *   @SWG\Parameter(name="group_id",in="path",description="group_id",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function limit($type, $group_id){
        return [
            'data' => Withdrawal::limit($type, $group_id)
        ];
    }

    /**
     * @SWG\Post(
     *   path="/withdrawal/withdraw",
     *   tags={"Withdraw"},
     *   summary="Withdrawal request",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="group_id",in="query",description="group id",required=true,type="integer"),
     *   @SWG\Parameter(name="amount",in="query",description="amount",required=true,type="number"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function withdraw(Request $request){
        $request->validate([
            'group_id' => 'required',
            'amount' => 'required',
        ]);

        $group = Group::find($request->group_id);        
        $member = Members::where("user_id", $request->user()->id)->where('group_id', $request->group_id)->first();

        if(!$member){
            return response()->json([
                'message' => 'You are not a member if this group'
            ]);   
        }
        if(!$member->is_admin){
            return response()->json([
                'message' => "You can't perform this action, you are not the group admin."
            ]);
        }
        if(!$group){
             return response()->json([
                'message' => "This group doesn't exist."
            ]);
        }

        $wallet = Wallet::group($group->id);
        if (!$wallet->canWithdraw($request->amount))
            return response()->json([
                'message' => 'Insufficient Group funds'
            ]);
        $withdrawal = Withdrawal::withdraw($member, $request->amount);
        $this->WithdrawalNotification($group);

        return response()->json([
			'message' => 'Successful. Your withdrawal request is being processed',
			"withdrawal" => $withdrawal
        ]);

    }


    public function WithdrawalNotification($group){
        $type  = NotificationTypes::where('type', 'INFORMATION')->first();
        $members  = $group->members();
        foreach ($members as $key) {
            $notify  = new Notification();
            $notify->user_id = $key->user_id;
            $notify->notification_types_id = $type->id;
            $notify->message  = $member->user()->name ." Has requested for withdrawal  from". $group->name . "group. Please take your time to accept";
            $notify->subject = "Withdrawal Request";
            $notify->save();
        }
    }

    /**
     * @SWG\Post(
     *   path="/withdrawal/approve",
     *   tags={"Withdraw"},
     *   summary="Withdrawal approval",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="code",in="query",description="code",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function approve(Request $request){
        $request->validate([
            'code' => 'required',
        ]);

        $withdrawal = Withdrawal::whereCode($request->code)->first();
        $group = Group::find($withdrawal->group_id);
        $member = Members::member($group->id);

        if (!$member->withdrawal_approver || $group->type()->first()->type !== 'Saving-and-investments')
            return response()->json([
                'message' => 'Unauthorized, you are not an approver'
            ], 401);

        if ($withdrawal->status === 'declined')
            return response()->json([
                'message' => 'Withdrawal request was declined'
            ], 403);

        if (WithdrawalApprovalEntry::hasApproved($withdrawal))
            return response()->json([
                'message' => 'You have already approved'
            ], 403);

        WithdrawalApprovalEntry::make($withdrawal);

        if ($group->type()->first()->type === 'Saving-and-investments'){
            //check 80% of approval
            $totalApprovals =count(WithdrawalApprovalEntry::entries($withdrawal));
            $totalApprovers = count(Members::where('group_id', $withdrawal->group_id)->get());
            $percentageApproved = ($totalApprovals/$totalApprovers) * 100;
            $withdrawal->status = $percentageApproved >= 80 ? 'approved' : 'processing';
        }else{
            $totaEntries = count(WithdrawalApprovalEntry::entries($withdrawal));
            $totaApprovers = count(Members::approvers($withdrawal->group_id, 'WITHDRAWAL'));
            $withdrawal->status = $totaApprovers === $totaEntries ? 'approved' : 'processing';
        }
        $withdrawal->approvers++;
        $withdrawal->save();

        return response()->json([
            'message' => 'Withdrawal approved successfully'
        ], 200);
    }

    /**
     * @SWG\Post(
     *   path="/withdrawal/decline",
     *   tags={"Withdraw"},
     *   summary="Withdrawal delcine",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="code",in="query",description="code",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function decline(Request $request){
        $request->validate([
            'code' => 'required',
        ]);

        $withdrawal = Withdrawal::whereCode($request->code)->first();
        $group = Group::find($withdrawal->group_id);
        $member = Members::member($withdrawal->group_id);

        if (!$member->withdrawal_approver || $group->type()->first()->type !== 'Saving-and-investments')
            return response()->json([
                'message' => 'Unauthorized, you are not an approver'
            ], 401);

        $withdrawal->status = 'declined';
        $withdrawal->modified_by = $request->user()->id;
        $withdrawal->save();
    }

    /**
     * @SWG\Post(
     *   path="/withdrawal/activity/withdraw",
     *   tags={"Withdraw"},
     *   summary="Event withdrawal request",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="activity_id",in="query",description="activity id",required=true,type="integer"),
     *   @SWG\Parameter(name="amount",in="query",description="amount",required=true,type="number"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function withdrawEvent(Request $request){
        $request->validate([
            'activity_id' => 'required',
            'amount' => 'required',
        ]);

        $activity = GroupActivity::find($request->activity_id);

        if ($request->amount > $activity->total_cost){
            return response()->json([
                'message' => 'Can not withdraw more than event total cost'
            ], 200);
        }

        $request->merge(['group_id' => $activity->group_id]);

       return $this->withdraw($request);
    }

    /**
     * @SWG\Post(
     *   path="/withdrawal/project/withdraw",
     *   tags={"Withdraw"},
     *   summary="Project withdrawal request",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="project_id",in="query",description="project id",required=true,type="integer"),
     *   @SWG\Parameter(name="amount",in="query",description="amount",required=true,type="number"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function withdrawProject(Request $request){
        $request->validate([
            'project_id' => 'required',
            'amount' => 'required',
        ]);

        $project = GroupProject::find($request->project_id);

        if ($request->amount > $project->estimated_cost || $request->amount > $project->actual_cost){
            return response()->json([
                'message' => 'Can not withdraw more than project total cost'
            ], 200);
        }

        $request->merge(['group_id' => $project->group_id]);

        return $this->withdraw($request);
    }
}
