<?php

namespace App;

class NextOfKin extends BaseModel
{
    protected $fillable = [
      'user_id',
      'name',
      'gender',
      'dob',
      'relationship',
      'phone',
      'email',
      'physical_address',
    ];
}
