<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvertSetup extends BaseModel
{
    protected $fillable = [
        'type',
        'description',
        'rate',
        'currency',
    ];
}
