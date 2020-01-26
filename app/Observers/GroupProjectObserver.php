<?php

namespace App\Observers;

use App\ContributionPeriod;
use App\ContributionType;
use App\GroupProject;
use App\Wallet;

class GroupProjectObserver
{
    /**
     * Handle the group project "created" event.
     *
     * @param  \App\GroupProject  $groupProject
     * @return void
     */
    public function created(GroupProject $groupProject)
    {
        $frequency = ContributionPeriod::find($groupProject->contribution_frequency);

        //init contribution
        if ($groupProject->allow_contributions){
            ContributionType::init([
                'group_id'  => $groupProject->group_id,
                'contribution_periods_id'  => $groupProject->contribution_frequency,
                'name'  => $frequency ? $frequency->name.' project contribution '.Wallet::group($groupProject->group_id)->currencyShortDesc().' '.$groupProject->contribution_amount : 'project contribution'.Wallet::group($groupProject->group_id)->currencyShortDesc().' '.$groupProject->contribution_amount,
                'description'  => $groupProject->description,
                'amount'  => $groupProject->contribution_amount,
                'target_amount'  => $groupProject->estimated_cost,
                'project_id' => $groupProject->id
            ]);
        }
    }

    /**
     * Handle the group project "updated" event.
     *
     * @param  \App\GroupProject  $groupProject
     * @return void
     */
    public function updated(GroupProject $groupProject)
    {
        $frequency = ContributionPeriod::find($groupProject->contribution_frequency);
        //init contribution
        if ($groupProject->allow_contributions){
            ContributionType::amend([
                'group_id'  => $groupProject->group_id,
                'contribution_periods_id'  => $groupProject->contribution_frequency,
                'name'  => $frequency ? $frequency->name.' project contribution '.Wallet::group($groupProject->group_id)->currencyShortDesc().' '.$groupProject->contribution_amount : 'project contribution'.Wallet::group($groupProject->group_id)->currencyShortDesc().' '.$groupProject->contribution_amount,
                'description'  => $groupProject->description,
                'amount'  => $groupProject->contribution_amount,
                'target_amount'  => $groupProject->estimated_cost,
                'project_id' => $groupProject->id
            ]);
        }
    }

    /**
     * Handle the group project "deleted" event.
     *
     * @param  \App\GroupProject  $groupProject
     * @return void
     */
    public function deleted(GroupProject $groupProject)
    {
        //
    }

    /**
     * Handle the group project "restored" event.
     *
     * @param  \App\GroupProject  $groupProject
     * @return void
     */
    public function restored(GroupProject $groupProject)
    {
        //
    }

    /**
     * Handle the group project "force deleted" event.
     *
     * @param  \App\GroupProject  $groupProject
     * @return void
     */
    public function forceDeleted(GroupProject $groupProject)
    {
        //
    }
}
