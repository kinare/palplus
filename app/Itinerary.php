<?php

namespace App;

class Itinerary extends BaseModel
{
    protected $fillable = ['activity_id', 'description', 'location', 'date'];
}
