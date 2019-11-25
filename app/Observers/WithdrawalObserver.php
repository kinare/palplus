<?php

namespace App\Observers;

use App\Group;
use App\Http\Controllers\AccountingController;
use App\Loan;
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
        $member =Members::member($group->id);
        dump($group);

        if ($type === 'Mary-go-round' || $type === 'Saving-and-investments'){

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
                'subject' => 'Withdrawal',
                'message' => 'Your withdrawal of '.$withdrawal->amount.' is successfull',
                'payload' => '',
                'notification_types_id' => NotificationTypes::getTypeId('WITHDRAWAL'),
            ]);
        }

        if ($type === 'Tours-and-travel' || $type === 'Fundraising'){

        }


        /*
         * validate group type
         * get group
         * if tour or fundraising transact amount to member wallet
         * validate if member is admin
         * if mary go round or savings create withdrawal notice
         * if mary go round notice to approvers only
         * if savings notice to all members
         *
         *  ['type' => 'Mary-go-round', 'description' => 'Mary Go Round'],
            ['type' => 'Tours-and-travel',  'description' => 'Tours and Travel'],
            ['type' => 'Fundraising',  'description' => 'Fundraising'],
            ['type' => 'Saving-and-investments',  'description' => 'Savings and Investments']
         */
    }

    /**
     * Handle the withdrawal "updated" event.
     *
     * @param  \App\Withdrawal  $withdrawal
     * @return void
     */
    public function updated(Withdrawal $withdrawal)
    {
        //
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
