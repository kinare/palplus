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

    protected $appends = ['avatar_url'];

    public function getAvatarUrlAttribute()
    {
        return url('/') .'/avatars/profiles/'.$this->id.'/'.$this->avatar;
    }
}
