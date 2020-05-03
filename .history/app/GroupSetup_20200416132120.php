<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupSetup extends Model
{
    protected $fillable = [
        'description',
        'amount',
        'currency',
    ];
}
