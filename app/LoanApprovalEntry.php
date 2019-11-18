<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LoanApprovalEntry extends BaseModel
{
    protected $fillable = [
        'loan_id',
        'approver_id',
        'status',
    ];

    public static function make(Loan $loan) : self
    {
        $self = new self();
        $self->loan_id = $loan->id;
        $self->approver_id = Members::member($loan->group_id)->id;
        $self->created_by = Auth::user()->id;
        $self->save();
        return $self;
    }

    public static function hasApproved(Loan $loan) : bool
    {
        return self::where([
            'loan_id' => $loan->id,
            'approver_id' =>  Members::member($loan->group_id)->id,
        ])->first() ? true : false;

    }

    public static function entries(Loan $loan)
    {
        return self::where([
            'loan_id' => $loan->id,
        ])->get();
    }
}
