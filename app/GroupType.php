<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupType extends BaseModel
{
    protected $fillable = [
        'type', 'description'
    ];
}
