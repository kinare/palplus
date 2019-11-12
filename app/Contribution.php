<?php

namespace App;


class Contribution extends BaseModel
{
    protected $fillable = [
        'contribution_types_id',
        'group_id',
        'member_id',
        'amount',
    ];

    public function type(){
        return $this->belongsTo('App\ContributionType', 'contribution_types_id', 'id')->withTrashed();
    }

    public function group(){
        return $this->hasOne('App\Group', 'id', 'group_id')->withTrashed();
    }
}
