<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Payment extends BaseModel
{
    protected $fillable = [
        'user_id',
        'description',
        'model',
        'model_id',
        'transaction_code',
        'amount',
        'status',
    ];

    public static function init(array $payment){
        $self = new self();
        $self->fill($payment);
        $self->created_by = Auth::user()->id;
        $self->save();
    }
}
