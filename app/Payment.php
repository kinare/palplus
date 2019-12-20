<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Payment extends BaseModel
{
    protected $fillable = [
        'user_id',
        'group_id',
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

    public function scopeStatus($query, $args){
        return $query->where('status', $args);
    }

    public static function total(Model $model){
        if ($model instanceof Members)
            $payments = self::status('pending')->whereUserId($model->user_id)->get();

        if ($model instanceof Group)
            $payments = self::status('pending')->whereGroupId($model->id)->get();

        if (!$model)
            $payments = self::status('pending')->get();

        $total = 0;
        foreach ($payments as $payment){
            $total += (float)$payment->amount;
        }
        return $total;
    }


}
