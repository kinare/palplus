<?php

namespace App\Observers;

use App\Invitation;
use App\Notification;
use App\NotificationTypes;

class InvitationObserver
{
    /**
     * Handle the invitation "created" event.
     *
     * @param  \App\Invitation  $invitation
     * @return void
     */
    public function created(Invitation $invitation)
    {
        Notification::make([
            'user_id' => $invitation->user_id,
            'subject' => 'Invitation',
            'message' => "Group Invitation",
            'payload' => $invitation->invitation_code,
            'notification_types_id' => NotificationTypes::getTypeId('INVITATION'),
        ]);
    }

    /**
     * Handle the invitation "updated" event.
     *
     * @param  \App\Invitation  $invitation
     * @return void
     */
    public function updated(Invitation $invitation)
    {
        //
    }

    /**
     * Handle the invitation "deleted" event.
     *
     * @param  \App\Invitation  $invitation
     * @return void
     */
    public function deleted(Invitation $invitation)
    {
        //
    }

    /**
     * Handle the invitation "restored" event.
     *
     * @param  \App\Invitation  $invitation
     * @return void
     */
    public function restored(Invitation $invitation)
    {
        //
    }

    /**
     * Handle the invitation "force deleted" event.
     *
     * @param  \App\Invitation  $invitation
     * @return void
     */
    public function forceDeleted(Invitation $invitation)
    {
        //
    }
}
