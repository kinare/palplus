<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationTypes extends BaseModel
{
    protected $fillable = [
        'type',
        'description'
    ];

    public static function getTypeId(string $type) : int
    {
        return self::where('type', mb_strtoupper($type))->first()->id;
    }
}
