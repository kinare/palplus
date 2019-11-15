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

    public static function hasContributions(Members $members, $amount = null) : bool
    {
        $contribs = self::where('member_id', $members->id)->get();
        if (!$contribs) return false;

        if ($amount){
            $value = 0;
            foreach ($contribs as $contrib){
                $value = (float)$contrib->amount + (float)$value;
            }
            return (float)$amount > $value;
        }

        return true;
    }

    public static function amount(Members $members){
        $contribs = self::where('member_id', $members->id)->get();
        if (!$contribs) return 0;
        $value = 0;
        foreach ($contribs as $contrib){
            $value = (float)$contrib->amount + (float)$value;
        }
        return $value;
    }
}
