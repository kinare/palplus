<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Group extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'access_level', 'type_id', 'country', 'currency_id', //'target_amount'
    ];

    public function members()
    {
        return $this->hasMany('App\Members')->where('deleted_at', NULL);
    }

    public function settings()
    {
        return $this->hasMany('App\GroupSetting', 'id', 'setting_id');
	}
	
	public static function currency($currency_id){
		return Currency::find($currency_id);
	}

    public function activities()
    {
        return $this->hasMany('App\GroupActivity', 'group_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo('App\GroupType', 'type_id', 'id')->where('deleted_at', null);
    }

    public function invitations()
    {
        return $this->hasMany('App\Invitation', 'group_id', 'id');
    }

    public function approvers()
    {
        return $this->hasMany('App\Approver')->where('deleted_at', NULL);
    }

    public function wallet()
    {
        return $this->hasOne('App\Wallet', 'id', 'wallet_id');
    }

    public function attachments()
    {
        return $this->hasMany('App\GroupAttachment', 'group_id', 'id');
    }

    protected $appends = ['avatar_url'];

    public function getAvatarUrlAttribute()
    {
        return url('/') .'/avatars/groups/'.$this->code.'/'.$this->avatar;
    }

    public static function hasFunds(self $self) : bool
    {
        return Wallet::where('group_id', $self->id)->first()->total_balance > 0;
    }

    public static function leaveStatus(Members $member){

        $loans = Loan::total($member);
        $contributions = Contribution::amount($member);
        $withdrawals = Withdrawal::total($member);
        $leaveGroupFee = GroupSetting::leaveGroupFee($member);

        return [
            'total_contributions' => $contributions,
            'total_withdrawals' => $withdrawals,
            'loan_balance' => $loans['balance'],
            'leaveGroupFee' => $leaveGroupFee,
            'total_withdrawable' => (float)$contributions - ((float)$withdrawals + (float)$loans['balance'] + $leaveGroupFee)
        ];
    }
}
