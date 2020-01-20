<?php

namespace App\Observers;

use App\Contribution;
use App\ContributionType;
use App\Group;
use App\GroupSetting;
use App\Members;
use App\Notification;
use App\NotificationTypes;
use App\Payment;

class MemberObserver
{
    /**
     * Handle the members "created" event.
     *
     * @param  \App\Members  $members
     * @return void
     */
    public function created(Members $members)
    {
        $setting = GroupSetting::where('group_id', $members->group_id)->first();
        $group = Group::find($members->group_id);

        dump($setting);

        if ($setting->membership_fee)
            /* Create pending payment for membership fee*/
            Payment::init([
                'user_id' => $members->user_id,
                'group_id' => $members->group_id,
                'description' => 'Membership Fee',
                'model' => ContributionType::class,
                'model_id' => ContributionType::where(['group_id'=>$members->group_id, 'membership_fee' => true])->first()->id,
                'transaction_code' =>'',
                'amount' =>  $setting->membership_fee_amount,
            ]);

            Notification::make([
                'user_id' => $members->user_id,
                'subject' => 'You have joined '.$group->name,
                'message' => $setting->membership_fee ? 'Pay '.$setting->membership_fee_amount.' to become active': "Thank you for joining",
                'payload' => '',
                'notification_types_id' => NotificationTypes::getTypeId('INFORMATION'),
            ]);
    }

    /**
     * Handle the members "updated" event.
     *
     * @param  \App\Members  $members
     * @return void
     */
    public function updated(Members $members)
    {
        //
    }

    /**
     * Handle the members "deleted" event.
     *
     * @param  \App\Members  $members
     * @return void
     */
    public function deleted(Members $members)
    {
        //
    }

    /**
     * Handle the members "restored" event.
     *
     * @param  \App\Members  $members
     * @return void
     */
    public function restored(Members $members)
    {
        //
    }

    /**
     * Handle the members "force deleted" event.
     *
     * @param  \App\Members  $members
     * @return void
     */
    public function forceDeleted(Members $members)
    {
        //
    }
}
