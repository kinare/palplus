<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class GroupActivity extends BaseModel
{
    protected $fillable = [
        'group_id', 'activity_type_id', 'name', 'description', 'itinerary',
        'contacts', 'start_date', 'end_date', 'cut_off_date', 'slots',
        'featured', 'booking_fee', 'installments', 'booking_fee_amount', 'has_contributions',
        'no_of_installments', 'instalment_amount', 'total_cost'
    ];

    protected $appends = ['avatar_url'];

    public function getAvatarUrlAttribute()
    {
        return url('/') .'/avatars/activities/'.$this->id.'/'.$this->avatar;
    }

    public function canJoin(): bool
    {
        return Carbon::now() > Carbon::parse($this->cut_off_date);
    }

    public function hasSlots(): bool
    {
        return (int)$this->slots > count(ActivityMembers::where('activity_id', $this->id)->get());
    }

    public function isMember($member_id)
    {
        return ActivityMembers::where('member_id', $member_id)->first();
    }

    public function hasJoined($group_id){
        return $this->isMember(
            Members::where([
                'user_id' => Auth::user()->id,
                'group_id' =>$group_id
            ])->first()->id
        );
    }
}
