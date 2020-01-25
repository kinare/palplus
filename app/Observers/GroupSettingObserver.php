<?php

namespace App\Observers;

use App\Contribution;
use App\ContributionCategory;
use App\ContributionPeriod;
use App\ContributionType;
use App\Group;
use App\GroupSetting;
use App\GroupType;
use App\Payment;

class GroupSettingObserver
{
    /**
     * Handle the group setting "created" event.
     *
     * @param GroupSetting $groupSetting
     * @return void
     */
    public function created(GroupSetting $groupSetting)
    {
        /* Get the respective group */
        $group = Group::find($groupSetting->group_id);

        /* Check for group type and update accordingly */
        switch (GroupType::find($group->type_id)->type){

            case 'Merry-go-round' :
                ContributionType::init([
                    'group_id' => $group->id,
                    'contribution_periods_id'  => $groupSetting->contribution_periods_id,
                    'name'  => ContributionPeriod::find($groupSetting->contribution_periods_id)->name.' contribution',
                    'description'  => $group->name.' contributions',
                    'amount'  => $groupSetting->contribution_amount,
                    'target_amount'  => $groupSetting->contribution_target_amount,
                    'type'  => 'Merry-go-round'
                ]);
                break;

            case 'Fundraising' :
                ContributionType::init([
                    'group_id' => $group->id,
                    'contribution_categories_id' => $groupSetting->contribution_categories_id,
                    'name'  => ContributionCategory::find($groupSetting->contribution_categories_id)->category.' Contribution',
                    'description'  => 'Fundraising for '.$group->name,
                    'amount'  => $groupSetting->contribution_amount ?: 0,
                    'target_amount'  => $groupSetting->contribution_target_amount?: 0,
                    'type'  => 'Fundraising'
                ]);

                break;

            case 'Saving-and-investments' :
                ContributionType::init([
                    'group_id' => $group->id,
                    'contribution_periods_id'  => $groupSetting->contribution_periods_id,
                    'contribution_categories_id' => $groupSetting->contribution_categories_id,
                    'name'  => ContributionPeriod::find($groupSetting->contribution_periods_id)->name.' contribution',
                    'description'  => 'Group Savings',
                    'type'  => 'Saving-and-investments'
                ]);
                break;
        }
    }

    /**
     * Handle the group setting "updated" event.
     *
     * @param GroupSetting $groupSetting
     * @return void
     */
    public function updated(GroupSetting $groupSetting)
    {
        /* Handle membership fee updates*/
        if ($groupSetting->isDirty('membership_fee')){
            if ($groupSetting->membership_fee)
                ContributionType::init([
                    'group_id' => $groupSetting->group_id,
                    'name' => 'Membership Fee',
                    'description' => 'Group Joining Fee',
                    'amount' => $groupSetting->membership_fee_amount,
                    'membership_fee' => $groupSetting->membership_fee,
                    'type' => 'Membership Fee',
                ]);

            if (!$groupSetting->membership_fee)
                ContributionType::where([
                    'group_id' => $groupSetting->group_id,
                    'membership_fee' => true
                ])->delete();
        }

        /* Handle other settings updates*/

        /* Get the respective group */
        $group = Group::find($groupSetting->group_id);

        /* Check for group type and update accordingly */
        switch (GroupType::find($group->type_id)->type){

            case 'Merry-go-round' :
                $contribytionType = ContributionType::where([
                    'group_id' => $group->id,
                    'type'  => 'Merry-go-round'
                ])->first();

                if (!$contribytionType) $contribytionType = new ContributionType();

                $contribytionType->fill([
                    'group_id' => $group->id,
                    'contribution_periods_id'  => $groupSetting->contribution_periods_id,
                    'name'  => ContributionPeriod::find($groupSetting->contribution_periods_id)->name.' contribution',
                    'description'  => $group->name.' contributions',
                    'amount'  => $groupSetting->contribution_amount,
                    'target_amount'  => $groupSetting->contribution_target_amount,
                    'type'  => 'Merry-go-round'
                ]);
                $contribytionType->save();
                break;

            case 'Fundraising' :
                $contribytionType = ContributionType::where([
                    'group_id' => $group->id,
                    'type'  => 'Fundraising'
                ])->first();

                $contribytionType->fill([
                    'group_id' => $group->id,
                    'contribution_categories_id' => $groupSetting->contribution_categories_id,
                    'name'  => ContributionCategory::find($groupSetting->contribution_categories_id)->category.' Contribution',
                    'description'  => 'Fundraising for '.$group->name,
                    'amount'  => $groupSetting->contribution_amount ?: 0,
                    'target_amount'  => $groupSetting->contribution_target_amount?: 0,
                    'type'  => 'Fundraising'
                ]);
                $contribytionType->save();
                break;

            case 'Saving-and-investments' :
                $contribytionType = ContributionType::where([
                    'group_id' => $group->id,
                    'type'  => 'Saving-and-investments'
                ])->first();

                $contribytionType->fill([
                    'group_id' => $group->id,
                    'contribution_periods_id'  => $groupSetting->contribution_periods_id,
                    'contribution_categories_id' => $groupSetting->contribution_categories_id,
                    'name'  => ContributionPeriod::find($groupSetting->contribution_periods_id)->name.' contribution',
                    'description'  => 'Group Savings',
                    'type'  => 'Saving-and-investments'
                ]);
                $contribytionType->save();
                break;
        }
    }

    /**
     * Handle the group setting "deleted" event.
     *
     * @param GroupSetting $groupSetting
     * @return void
     */
    public function deleted(GroupSetting $groupSetting)
    {
        //
    }

    /**
     * Handle the group setting "restored" event.
     *
     * @param GroupSetting $groupSetting
     * @return void
     */
    public function restored(GroupSetting $groupSetting)
    {
        //
    }

    /**
     * Handle the group setting "force deleted" event.
     *
     * @param GroupSetting $groupSetting
     * @return void
     */
    public function forceDeleted(GroupSetting $groupSetting)
    {
        //
    }
}
