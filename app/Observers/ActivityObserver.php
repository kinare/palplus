<?php

namespace App\Observers;

use App\ContributionType;
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
        if ($activity->has_contributions){

            if ($activity->booking_fee){
                ContributionType::init([
                    'group_id'  => $activity->group_id,
                    'booking_fee'  => $activity->booking_fee,
                    'name'  => 'Booking Fee',
                    'description'  => $activity->name.' booking fee',
                    'amount'  => $activity->booking_fee_amount,
                    'target_amount'  => $activity->total_cost,
                    'activity_id' => $activity->id
                ]);
            }

            if ($activity->installments){
                for ($i = 1; $i <= (int)$activity->no_of_installments; $i++){
                    ContributionType::init([
                        'group_id'  => $activity->group_id,
                        'name'  => ($i + 1) .' '.$activity->name.' '.$activity->instalment_amount,
                        'description'  => 'Instalments for '.$activity->name,
                        'amount'  => $activity->instalment_amount,
                        'target_amount'  => $activity->total_cost,
                        'activity_id' => $activity->id
                    ]);
                }

            }

        }


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
