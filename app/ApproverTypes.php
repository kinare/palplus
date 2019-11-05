<?php

namespace App;


class ApproverTypes extends BaseModel
{
    protected $fillable = [
      'type',
      'description'
    ];

    public static  function type($type){
        return self::whereType($type)->first();
    }

}
