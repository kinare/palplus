<?php

namespace App;

class GroupProject extends BaseModel
{
    protected $fillable = [
        'group_id',
        'name',
        'description',
        'estimated_cost',
        'actual_cost',
        'start_date',
        'end_date',
        'location',
        'allow_contributions',
        'contribution_amount',
        'contribution_frequency',
        'enable_reminders'
    ];



}
