<?php

namespace App;

class ActivityType extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'activity', 'description'
    ];
}
