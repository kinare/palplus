<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Members extends BaseModel
{
    protected $fillable = [
        'group_id', 'user_id', 'setting_id', 'profile_id'
    ];
}
