<?php

namespace App;


class Invitation extends BaseModel
{
    protected $fillable = [
        'invitation_code',
        'group_id',
        'user_id',
        'phone',
    ];
}
