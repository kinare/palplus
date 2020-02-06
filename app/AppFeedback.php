<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppFeedback extends BaseModel
{
    protected $fillable = [
        'user_id',
        'feedback',
    ];
}
