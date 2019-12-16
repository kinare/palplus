<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    public static function type(String $type) : self
    {
        return self::whereType($type)->first();
    }
}
