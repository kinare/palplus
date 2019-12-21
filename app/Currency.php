<?php

namespace App;


class Currency extends BaseModel
{
    protected $fillable = [
        'currency', 'short_description', 'country', 'rate'
    ];

    public static function byCountry(string $country) : int
    {
        return self::where('country', 'LIKE', '%'.$country.'%')->first()->id;
    }

}
