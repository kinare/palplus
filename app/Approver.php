<?php

namespace App;


class Approver extends BaseModel
{
    protected $fillable = [
        'member_id',
        'approver_type_id',
    ];

    public function members(){
        return $this->belongsTo('App\Members', 'member_id', 'id')->where('deleted_at', NULL);
    }
}
