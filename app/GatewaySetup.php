<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GatewaySetup extends BaseModel
{
    protected $fillable =[
      'type',
      'gateway',
      'rate',
      'active'
    ];
}
