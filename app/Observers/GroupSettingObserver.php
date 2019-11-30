<?php

namespace App\Observers;

use App\ContributionCategory;
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
        $group = Group::find($groupSetting->group_id);
        $settings = GroupSetting::where('group_id', $group->id)->first();

        switch (GroupType::find($group->type_id)->type){
            case 'Merry-go-round' :
                ContributionType::init([
                    'group_id' => $group->id,
                    'contribution_periods_id'  => $settings->contribution_periods_id,
                    'name'  => 'Savings',
                    'description'  => $group->name.' contributions',
                    'amount'  => $settings->contribution_amount,
                    'target_amount'  => $settings->contribution_target_amount
                ]);
                break;
            case 'Tours-and-travel' :
                //Todo Generate form event
                break;
            case 'Fundraising' :
                ContributionType::init([
                    'group_id' => $group->id,
//                    'contribution_periods_id'  => $settings->contribution_periods_id,
                    'contribution_categories_id' => $settings->contribution_categories_id,
                    'name'  => ContributionCategory::find($settings->contribution_categories_id)->category,
                    'description'  => 'Fundraising for '.$group->name,
                    'amount'  => $settings->contribution_amount ?: 0,
                    'target_amount'  => $settings->contribution_target_amount?: 0
                ]);
                break;
            case 'Saving-and-investments' :
                ContributionType::init([
                    'group_id' => $group->id,
                    'contribution_periods_id'  => $settings->contribution_periods_id,
                    'contribution_categories_id' => $settings->contribution_categories_id,
                    'name'  => 'Savings',
                    'description'  => 'Group Savings',
                ]);
                break;
        }

        //
        if ($groupSetting->membership_fee)
            ContributionType::init([
                'group_id' => $groupSetting->group_id,
                'name' => 'Membership Fee',
                'description' => 'Group Joining Fee',
                'amount' => $groupSetting->membership_fee_amount,
                'membership_fee' => $groupSetting->membership_fee,
            ]);
    }

    /**
     * Handle the group setting "updated" event.
     *
     * @param GroupSetting $groupSetting
     * @return void
     */
    public function updated(GroupSetting $groupSetting)
    {
        if ($groupSetting->isDirty('membership_fee')){
            if ($groupSetting->membership_fee)
                ContributionType::init([
                    'group_id' => $groupSetting->group_id,
                    'name' => 'Membership Fee',
                    'description' => 'Group Joining Fee',
                    'amount' => $groupSetting->membership_fee_amount,
                    'membership_fee' => $groupSetting->membership_fee,
                ]);

            if (!$groupSetting->membership_fee)
                $contrib = ContributionType::where([
                    'group_id' => $groupSetting->group_id,
                    'membership_fee' => true
                ])->first();
            $contrib->delete();
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
