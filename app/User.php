<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use SMartins\PassportMultiauth\HasMultiAuthApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasMultiAuthApiTokens, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'country_code', 'currency_id', 'phone', 'password', 'verification_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function activated() : bool
    {
        return $this->active && $this->verification_code === '' && $this->phone_verified;
    }

    /**
     * Find the user instance for the given username.
     *
     * @param  string  $phone
     * @return \App\User
     */
    public function findForPassport($phone)
    {
        return $this->where('phone', $phone)->first();
    }

    public function wallet(){
        return $this->hasOne('App\Wallet')->where('deleted_at', NUll);
    }

    public function profile(){
        return $this->hasOne('App\Profile')->where('deleted_at', NUll);
    }

    public function nok(){
        return $this->hasOne('App\NextOfKin')->where('deleted_at', NUll);
    }

    public function groups(){
        return $this->hasManyThrough('App\Group', 'App\Members', 'user_id', 'id');
    }

    public function transactions(){
        return $this->hasManyThrough('App\Transaction', 'App\Wallet', 'user_id', 'id');
    }

    public function accounts(){
        return $this->hasOne('App\Account')->where('deleted_at', NUll);
    }

    public function payments(){
        return $this->hasManyThrough('App\Payment', 'App\Wallet', 'user_id', 'id');
    }

    public function loans(){
        return $this->hasMany('App\Loan')->where('deleted_at', NUll);
    }
}
