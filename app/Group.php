<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Group extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'access_level', 'type_id', 'country', 'currency'
    ];

    public function members()
    {
        return $this->hasMany('App\Members')->where('deleted_at', NULL);
    }

    public function settings()
    {
        return $this->hasMany('GroupSetting', 'id', 'setting_id');
    }

    public function activities()
    {
        return $this->hasMany('GroupActivity', 'group_id', 'id');
    }

    public function type()
    {
        return $this->hasOne('GroupType', 'id', 'type_id');
    }

    public function invitations()
    {
        return $this->hasMany('Invitation', 'group_id', 'id');
    }

    public function approvers()
    {
        return $this->hasMany('App\Approver')->where('deleted_at', NULL);
    }

    public function wallet()
    {
        return $this->hasOne('Wallet', 'id', 'wallet_id');
    }

    public function attachments()
    {
        return $this->hasMany('GroupAttachment', 'group_id', 'id');
    }
}
