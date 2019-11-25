<?php

namespace App;

class WithdrawalSetting extends BaseModel
{
    protected $fillable = [
        'group_id',
        'qualification_period',
        'show_withdrawal'
    ];

    public static function init(Group $group){
        $self = new self();
        $self->group_id = $group->id;
        $self->qualification_period = 0;
        $self->save();
    }
}
