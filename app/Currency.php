<?php

namespace App;


class Currency extends BaseModel
{
    protected $fillable = [
        'currency', 'short_description', 'country', 'rate'
    ];
}
