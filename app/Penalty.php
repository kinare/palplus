<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penalty extends BaseModel
{
    protected $fillable = [
        'member_id',
        'reason',
        'amount',
    ];
}
