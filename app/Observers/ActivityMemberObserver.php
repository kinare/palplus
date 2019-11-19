<?php

namespace App\Observers;

use App\ActivityMembers;
use App\GroupActivity;

class ActivityMemberObserver
{
    /**
     * Handle the activity members "created" event.
     *
     * @param  \App\ActivityMembers  $activityMembers
     * @return void
     */
    public function created(ActivityMembers $member)
    {
        //check slots
        $activity = GroupActivity::find($member->activity_id);
        if (isset($activity->slots)){
            $activity->slots--;
            $activity->save();
        }
    }

    /**
     * Handle the activity members "updated" event.
     *
     * @param  \App\ActivityMembers  $activityMembers
     * @return void
     */
    public function updated(ActivityMembers $activityMembers)
    {
        //
    }

    /**
     * Handle the activity members "deleted" event.
     *
     * @param  \App\ActivityMembers  $activityMembers
     * @return void
     */
    public function deleted(ActivityMembers $activityMembers)
    {
        //
    }

    /**
     * Handle the activity members "restored" event.
     *
     * @param  \App\ActivityMembers  $activityMembers
     * @return void
     */
    public function restored(ActivityMembers $activityMembers)
    {
        //
    }

    /**
     * Handle the activity members "force deleted" event.
     *
     * @param  \App\ActivityMembers  $activityMembers
     * @return void
     */
    public function forceDeleted(ActivityMembers $activityMembers)
    {
        //
    }
}
