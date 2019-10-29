<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Members extends BaseModel
{
    protected $fillable = [
        'group_id', 'user_id', 'setting_id', 'profile_id'
    ];

    public function user()
    {
        return $this->belongsTo("App\User")->withTrashed();
    }
}
