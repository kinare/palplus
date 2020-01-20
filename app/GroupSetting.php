<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupSetting extends BaseModel
{
    protected $fillable = [
        'membership_fee',
        'membership_fee_amount',
        'contributions',
        'contribution_periods_id',
        'contribution_amount',
        'contribution_target_amount',
        'contribution_categories_id',
        'send_reminders',
        'fixed_late_penalty',
        'late_penalty_rate',
        'late_penalty_amount',
        'fixed_leaving_group_fee',
        'leaving_group_fee',
        'leaving_group_rate',
        'group_id'
    ];

    public function group(){
        return $this->hasOne('App\Group', 'id', 'group_id');
    }

    public static function leaveGroupFee(Members $member){

        if ($member->leave_group_fee_paid) return 0;

        $setting = self::whereGroupId($member->group_id)->first();
        if (!$setting->fixed_leaving_group_fee){
            return ((float)$setting->leaving_group_rate * (float)Contribution::amount($member))/100;
        }
        return $setting->leaving_group_fee;
    }
}
