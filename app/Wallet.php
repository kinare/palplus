<?php

namespace App;


class Wallet extends BaseModel
{
    protected $fillable = [
      'type',
      'user_id',
      'group_id',
    ];
}
