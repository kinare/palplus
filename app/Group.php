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
        'name', 'description', 'access_level', 'country', 'currency'
    ];

    public function members()
    {
        return $this->hasMany('Members', 'group_id', 'id');
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
        return $this->hasMany('GroupType', 'id', 'type_id');
    }

    public function invitations()
    {
        return $this->hasMany('Invitation', 'group_id', 'id');
    }

    public function approvers()
    {
        return $this->hasMany('Approver', 'group_id', 'id');
    }

    public function wallet()
    {
        return $this->hasMany('Wallet', 'id', 'wallet_id');
    }

    public function attachments()
    {
        return $this->hasMany('GroupAttachment', 'group_id', 'id');
    }
}
