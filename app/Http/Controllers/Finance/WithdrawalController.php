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








        /*
         * fetch the withdrawal record -ok
         * get group -ok
         * get approvers -ok
         * validate approver and  approval entry
         * create approval entry
         * if last approver change status to approved
         *
         * observer
         * transact withdrawal to member wallet
         * create member notice of successfull withdrawal
         *
         * */
    }

    public function decline(Request $request){
        $request->validate([
            'code' => 'required',
        ]);

        /*
        * fetch the withdrawal record
        * get group
        * get approvers
        * validate approver
        * decline withdrawal
        * observer
        * notify member of decline
        *
        * */
    }
}
