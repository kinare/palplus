<?php

namespace App;

use Auth;

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

    public static function init(User $user){
        $profile = new self();
        $profile->user_id = $user->id;
        $profile->created_by = Auth::id();
        $profile->save();
    }
}
