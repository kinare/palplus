<?php

namespace App\Http\Controllers\Finance;

use App\Group;
use App\Http\Controllers\BaseController;
use App\Http\Resources\WithdrawalResource;
use App\Members;
use App\Wallet;
use App\Withdrawal;
use Illuminate\Http\Request;

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
        $withdrawal->group_id = $group->id;
        $withdrawal->member_id = $member->id;
        $withdrawal->amount = $request->amount;
        $withdrawal->save();

        return response()->json([
            'message' => 'Successful. Your withdrawal request is being processed'
        ], 403);





        /*
         * validate withdrawal request -ok
         * get group -ok
         * get member -ok
         * get group wallet -ok
         * validate if can withdraw -ok
         *
         * on observer

         *
         *
         * */
    }

    public function approve(Request $request){
        $request->validate([
            'code' => 'required',
        ]);

        /*
         * fetch the withdrawal record
         * get group
         * get approvers
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
