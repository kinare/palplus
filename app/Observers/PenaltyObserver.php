<?php

namespace App\Observers;

use App\Members;
use App\Notification;
use App\NotificationTypes;
use App\Payment;
use App\Penalty;
use Carbon\Carbon;

class PenaltyObserver
{
    /**
     * Handle the penalty "created" event.
     *
     * @param  \App\Penalty  $penalty
     * @return void
     */
    public function created(Penalty $penalty)
    {
        $member = Members::find($penalty->member_id);

        //create a pending payment for the penalty
        Payment::init([
            'user_id' => $member->user_id,
            'group_id' => $member->group_id,
            'description' => 'Member Penalty',
            'model' => Penalty::class,
            'model_id' => $penalty->id,
            'transaction_code' => 'PEN'.Carbon::now()->timestamp,
            'amount' =>  $penalty->amount,
        ]);

        /* notify member of penalty */
        Notification::make([
            'user_id' => $member->user_id,
            'subject' => 'You have been penalized',
            'message' => $penalty->reason,
            'payload' => '',
            'notification_types_id' => NotificationTypes::getTypeId('INFORMATION'),
        ]);
    }

    /**
     * Handle the penalty "updated" event.
     *
     * @param  \App\Penalty  $penalty
     * @return void
     */
    public function updated(Penalty $penalty)
    {

    }

    /**
     * Handle the penalty "deleted" event.
     *
     * @param  \App\Penalty  $penalty
     * @return void
     */
    public function deleted(Penalty $penalty)
    {
        //
    }

    /**
     * Handle the penalty "restored" event.
     *
     * @param  \App\Penalty  $penalty
     * @return void
     */
    public function restored(Penalty $penalty)
    {
        //
    }

    /**
     * Handle the penalty "force deleted" event.
     *
     * @param  \App\Penalty  $penalty
     * @return void
     */
    public function forceDeleted(Penalty $penalty)
    {
        //
    }
}
