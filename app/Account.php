<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends BaseModel
{
    protected $fillable = ['user_id', 'account_type_id', 'number', 'name', 'address', 'country', 'cvv', 'limit', 'expiry'];
}
