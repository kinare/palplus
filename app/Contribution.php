<?php

namespace App;


use Illuminate\Support\Facades\Auth;

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

    public static function total($type = null, $id = null) : float
    {
        if ($type){
            $contributions = $type === 'GROUP' ? Contribution::where('group_id', $id)->get() : Contribution::where('member_id', $id)->get();
        }else{
            $contributions = Contribution::all();
        }

        $total = 0;
        foreach ($contributions as $contribution){
            $total += (float)$contribution->amount;
        }
        return $total;
    }

    public static function contribute(ContributionType $type, Members $member, float $amount) : self
    {
        $contribution = new self();
        $contribution->contribution_types_id = $type->id;
        $contribution->group_id = $type->group_id;
        $contribution->member_id = $member->id;
        $contribution->amount = $amount;
        $contribution->created_by = Auth::user()->id;
        $contribution->save();
        return $contribution;
    }
}
