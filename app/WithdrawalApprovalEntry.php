<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class WithdrawalApprovalEntry extends BaseModel
{
    protected $fillable = [
        'withdrawal_id',
        'approver_id',
        'status',
    ];

    public static function make(Withdrawal $withdrawal) : self
    {
        $self = new self();
        $self->withdrawal_id = $withdrawal->id;
        $self->approver_id = Members::member($withdrawal->group_id)->id;
        $self->created_by = Auth::user()->id;
        $self->save();
        return $self;
    }


    public static function hasApproved(Withdrawal $withdrawal)
    {
        return self::where([
            'withdrawal_id' => $withdrawal->id,
            'approver_id' =>  Members::member($withdrawal->group_id)->id,
        ])->first();

    }

    public static function entries(Withdrawal $withdrawal)
    {
        return self::where([
            'withdrawal_id' => $withdrawal->id,
        ])->get();
    }
}
