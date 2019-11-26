<?php

namespace App;

class Withdrawal extends BaseModel
{
    protected $fillable = [
        'group_id',
        'member_id',
        'amount',
    ];

    public static function limit($type, $group_id) : array
    {
        $setting = GroupSetting::where('group_id', $group_id)->first();
        $member = Members::member($group_id);
        $contributions = Contribution::total($type, $type === 'GROUP' ? $group_id : $member->id);
        $loan = (float)Loan::total($type, $type === 'GROUP' ? $group_id : $member->id)['balance'];
        $leave = (float)$setting->leaving_group_fee;
        return [
            'contributions' => $contributions,
            'loans' => $loan,
            'leave_group_fee' =>$setting->leaving_group_fee,
            'total' => $contributions - ($loan + $leave),
        ];
    }
}
