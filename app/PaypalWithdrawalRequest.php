<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaypalWithdrawalRequest extends BaseModel
{
    protected $fillable = [
        'user_id',
        'url',
        'amount'
    ];

    public static function make($url, $amount)
    {
        $self = new self();
        $self->user_id = \Auth::user()->id;
        $self->url = $url;
        $self->amount = $amount;
        $self->save();
        return $self;
    }
}
