<?php

namespace App\Observers;

use App\GroupActivity;

class ActivityObserver
{
    /**
     * Handle the group activity "created" event.
     *
     * @param  \App\GroupActivity  $groupActivity
     * @return void
     */
    public function created(GroupActivity $activity)
    {
//        if ($activity->)
    }

    /**
     * Handle the group activity "updated" event.
     *
     * @param  \App\GroupActivity  $groupActivity
     * @return void
     */
    public function updated(GroupActivity $groupActivity)
    {
        //
    }

    /**
     * Handle the group activity "deleted" event.
     *
     * @param  \App\GroupActivity  $groupActivity
     * @return void
     */
    public function deleted(GroupActivity $groupActivity)
    {
        //
    }

    /**
     * Handle the group activity "restored" event.
     *
     * @param  \App\GroupActivity  $groupActivity
     * @return void
     */
    public function restored(GroupActivity $groupActivity)
    {
        //
    }

    /**
     * Handle the group activity "force deleted" event.
     *
     * @param  \App\GroupActivity  $groupActivity
     * @return void
     */
    public function forceDeleted(GroupActivity $groupActivity)
    {
        //
    }
}
