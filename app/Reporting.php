<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reporting extends BaseModel
{
    protected $fillable = [
      'user_id',
      'group_id',
      'message',
    ];
}
