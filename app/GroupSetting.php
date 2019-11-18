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
        'send_reminders',
        'fixed_late_penalty',
        'late_penalty_rate',
        'late_penalty_amount',
        'leaving_group_fee',
        'group_id'
    ];

    public function group(){
        return $this->hasOne('App\Group', 'id', 'group_id');
    }
}
