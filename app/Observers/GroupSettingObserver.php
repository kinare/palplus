<?php

namespace App\Observers;

use App\Group;
use App\GroupSetting;
use App\Http\Controllers\Contributions\ContributionTypeController;

class GroupSettingObserver
{
    /**
     * Handle the group setting "created" event.
     *
     * @param  \App\GroupSetting  $groupSetting
     * @return void
     */
    public function created(GroupSetting $groupSetting)
    {
        //init contributions
        ContributionTypeController::init(Group::find($groupSetting->group_id));
    }

    /**
     * Handle the group setting "updated" event.
     *
     * @param  \App\GroupSetting  $groupSetting
     * @return void
     */
    public function updated(GroupSetting $groupSetting)
    {

    }

    /**
     * Handle the group setting "deleted" event.
     *
     * @param  \App\GroupSetting  $groupSetting
     * @return void
     */
    public function deleted(GroupSetting $groupSetting)
    {
        //
    }

    /**
     * Handle the group setting "restored" event.
     *
     * @param  \App\GroupSetting  $groupSetting
     * @return void
     */
    public function restored(GroupSetting $groupSetting)
    {
        //
    }

    /**
     * Handle the group setting "force deleted" event.
     *
     * @param  \App\GroupSetting  $groupSetting
     * @return void
     */
    public function forceDeleted(GroupSetting $groupSetting)
    {
        //
    }
}
