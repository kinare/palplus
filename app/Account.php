<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends BaseModel
{
    protected $fillable = [
        'user_id',
        'account_type_id',
        'number',
        'email',
        'phonenumber',
        'firstname',
        'lastname',
        'expirymonth',
        'expiryyear',
        'address',
        'country',
        'cvv',
        'currency',
        'billingzip',
        'billingcity',
        'billingaddress',
        'billingstate',
        'billingcountry',
        'accountbank',
        'beneficiary'
    ];

    public function name(){
        return $this->firstname.' '.$this->lastname;
    }
}
