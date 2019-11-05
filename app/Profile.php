<?php

namespace App;

class Profile extends BaseModel
{
    protected $fillable = [
      'user_id',
      'dob',
      'gender',
      'physical_address',
    ];
}
