<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityMembers extends BaseModel
{
    protected $fillable = [
      'group_id',
      'member_id',
      'activity_id',
      'status',
    ];
}
