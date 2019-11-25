<?php

namespace App\Http\Controllers\Finance;

use App\Group;
use App\Http\Controllers\BaseController;
use App\Http\Resources\WithdrawalResource;
use App\Members;
use App\Wallet;
use App\Withdrawal;
use App\WithdrawalApprovalEntry;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WithdrawalController extends BaseController
{
    public function __construct($model = Withdrawal::class, $resource = WithdrawalResource::class)
    {
        parent::__construct($model, $resource);
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
        $member = Members::member($group->id);
        $wallet = Wallet::group($group->id);

        if (!$wallet->canWithdraw($request->amount))
            return response()->json([
                'message' => 'Insufficient funds'
            ], 403);

        $withdrawal = new Withdrawal();
        $withdrawal->code = Str::random(10).Carbon::now()->timestamp;
        $withdrawal->group_id = $group->id;
        $withdrawal->member_id = $member->id;
        $withdrawal->amount = $request->amount;
        $withdrawal->save();

        return response()->json([
            'message' => 'Successful. Your withdrawal request is being processed'
        ], 403);
    }

    /**
     * @SWG\Post(
     *   path="/withdrawal/approval",
     *   tags={"Withdraw"},
     *   summary="Withdrawal approval",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="code",in="query",description="code",required=true,type="string"),
     *   @SWG\Parameter(name="repayment_period",in="query",description="repayment period",required=true,type="integer"),
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

        if (!$member->withdrawal_approver)
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
        $withdrawal->approvals++;
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
     *   @SWG\Parameter(name="repayment_period",in="query",description="repayment period",required=true,type="integer"),
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
        $member = Members::member($withdrawal->group_id);

        if (!$member->withdrawal_approver)
            return response()->json([
                'message' => 'Unauthorized, you are not an approver'
            ], 401);

        $withdrawal->status = 'declined';
        $withdrawal->modified_by = $request->user()->id;
        $withdrawal->save();


    }
}
