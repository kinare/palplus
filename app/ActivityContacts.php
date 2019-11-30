<?php

namespace App;

class ActivityContacts extends BaseModel
{
    protected $fillable = ['activity_id', 'name', 'email', 'location', 'phone'];
}
