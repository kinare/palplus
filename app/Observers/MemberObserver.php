<?php

namespace App\Observers;

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
        if ($groupSetting->membership_fee)
            Payment::init([
                'user_id' => ,
                'description',
                'model',
                'model_id',
                'transaction_code',
                'amount',
                'status',
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
