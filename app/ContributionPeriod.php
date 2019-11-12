<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContributionPeriod extends BaseModel
{
    protected $fillable = [
        'name',
        'length',
        'period',
    ];
}
