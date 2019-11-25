<?php

namespace App;

class Withdrawal extends BaseModel
{
    protected $fillable = [
        'group_id',
        'member_id',
        'amount',
    ];
}
