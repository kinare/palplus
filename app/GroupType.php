<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupType extends BaseModel
{
    protected $fillable = [
        'type', 'description'
    ];

    public static function type($id){
        return self::find($id)->type;
    }
}
