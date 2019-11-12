<?php

namespace App;

class GroupRequests extends BaseModel
{
    protected $fillable = [
      'group_id',
      'user_id',
      'status',
      'request_code',
    ];
}
