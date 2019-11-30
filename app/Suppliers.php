<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suppliers extends BaseModel
{
    protected $fillable = [
        'activity_id',
        'name',
        'location',
        'description',
        'phone',
        'email',
        'currency',
        'amount_paid',
        'amount_pending',
    ];
}
