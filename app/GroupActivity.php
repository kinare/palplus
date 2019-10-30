<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupActivity extends BaseModel
{
    protected $fillable = [
        'group_id', 'activity_type_id', 'name', 'description', 'itinerary',
        'contacts', 'start_date', 'end_date', 'cut_off_date', 'slots',
        'featured', 'booking_fee', 'installments', 'no_of_installments',
        'booking_fee_amount', 'instalment_amount', 'total_cost'
    ];
}
