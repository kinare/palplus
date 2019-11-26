<?php

namespace App\Observers;

use App\Group;
use App\Http\Controllers\AccountingController;
use App\Members;
use App\Notification;
use App\NotificationTypes;
use App\Wallet;
use App\Withdrawal;
use Carbon\Carbon;
use Illuminate\Support\Str;

class WithdrawalObserver
{
    /**
     * Handle the withdrawal "created" event.
     *
     * @param \App\Withdrawal $withdrawal
     * @return void
     * @throws \Exception
     */
    public function created(Withdrawal $withdrawal)
    {
        $group = Group::find($withdrawal->group_id);
        $type = $group->type()->first()->type;
        $member = Members::member($group->id);

        if ($type === 'Saving-and-investments'){
            $members = Members::where('group_id', $group->id);

            foreach ($members as $memb){
                Notification::make([
                    'user_id' => $memb->id,
                    'subject' => 'Withdrawal Request',
                    'message' => 'Approve '.$member->user()->first()->name.' withdrawal of '.$withdrawal->amount,
                    'payload' => $withdrawal->code,
                    'notification_types_id' => NotificationTypes::getTypeId('WITHDRAWAL'),
                ]);
            }

        }

        if ($type === 'Merry-go-round'){
            $approvers = Members::approvers($group->id, 'WITHDRAWAL');
            foreach ($approvers as $approver){
                Notification::make([
                    'user_id' => $approver->id,
                    'subject' => 'Withdrawal Request',
                    'message' => 'Approve '.$member->user()->first()->name.' withdrawal of '.$withdrawal->amount,
                    'payload' => $withdrawal->code,
                    'notification_types_id' => NotificationTypes::getTypeId('WITHDRAWAL'),
                ]);
            }
        }

        if ($type === 'Tours-and-travel' || $type === 'Fundraising'){
            AccountingController::transact(
                Wallet::group($group->id),
                Wallet::mine(),
                $withdrawal->amount,
                [
                    'model' => Withdrawal::class,
                    'model_id' => $withdrawal->id,
                    'description' => 'Withdrawal',
                    'account' => '',
                    'transaction_code' => Str::random(10).Carbon::now()->timestamp,
                ]
            );

            Notification::make([
                'user_id' => $member->id,
                'subject' => 'Withdrawal Success',
                'message' => 'Successfully withdrawal of '.$withdrawal->amount,
                'payload' => $withdrawal->code,
                'notification_types_id' => NotificationTypes::getTypeId('INFORMATION'),
            ]);
        }
    }

    /**
     * Handle the withdrawal "updated" event.
     *
     * @param  \App\Withdrawal  $withdrawal
     * @return void
     */
    public function updated(Withdrawal $withdrawal)
    {
        if ($withdrawal->isDirty('status')){

            if ($withdrawal->status = 'approved'){

                //transact
                AccountingController::transact(
                    Wallet::group($withdrawal->group_id),
                    Wallet::where('user_id', Members::find($withdrawal->member_id)->user_id)->first(),
                    $withdrawal->amount,
                    [
                        'model' => Withdrawal::class,
                        'model_id' => $withdrawal->id,
                        'description' => 'Withdrawal',
                        'account' => '',
                        'transaction_code' => Str::random(10).Carbon::now()->timestamp,
                    ]
                );

                //notify
                Notification::make([
                    'user_id' => Members::find($withdrawal->member_id)->user_id,
                    'subject' => 'Withdrawal Approval',
                    'message' => 'Your Withdrawal of '.$withdrawal->amount.' has been approved',
                    'payload' => '',
                    'notification_types_id' => NotificationTypes::getTypeId('APPROVAL'),
                ]);
            }

            if ($withdrawal->status === 'declined'){
                Notification::make([
                    'user_id' => Members::find($withdrawal->member_id)->user_id,
                    'subject' => 'Loan Application',
                    'message' => 'Your withdrawal of '.$withdrawal->loan_amount.' has been declined',
                    'payload' => '',
                    'notification_types_id' => NotificationTypes::getTypeId('APPROVAL'),
                ]);
            }
        }
    }

    /**
     * Handle the withdrawal "deleted" event.
     *
     * @param  \App\Withdrawal  $withdrawal
     * @return void
     */
    public function deleted(Withdrawal $withdrawal)
    {
        //
    }

    /**
     * Handle the withdrawal "restored" event.
     *
     * @param  \App\Withdrawal  $withdrawal
     * @return void
     */
    public function restored(Withdrawal $withdrawal)
    {
        //
    }

    /**
     * Handle the withdrawal "force deleted" event.
     *
     * @param  \App\Withdrawal  $withdrawal
     * @return void
     */
    public function forceDeleted(Withdrawal $withdrawal)
    {
        //
    }
}
