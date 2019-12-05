<?php

namespace App\Observers;

use App\Contribution;
use App\GroupSetting;
use App\Members;
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
        if ($setting->membership_fee)
            Payment::init([
                'user_id' => $members->user_id,
                'group_id' => $members->group_id,
                'description' => 'Membership Fee',
                'model' => Contribution::class,
                'model_id' => Contribution::where(['group_id'=>$members->group_id, 'membership_fee' => true])->first()->id,
                'transaction_code' =>'',
                'amount' =>  $setting->membership_fee,
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
