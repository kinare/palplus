<?php

namespace App;

class LoanSetting extends BaseModel
{
    protected $fillable = [
        'group_id',
        'qualification_period',
        'repayment_period',
        'fixed_amount',
        'limit_rate',
        'limit_amount',
        'interest_rate',
        'fixed_late_payment',
        'late_payment_rate',
        'late_payment_amount',
        'show_loans',
    ];

    public static function settings($group_id) : self
    {
        return self::where('group_id', $group_id)->first();
    }

    public function period(){
        return $this->hasOne('App\LoanPeriod', 'id', 'repayment_period');
    }

    public static function init(Group $group){
        $self = new self();
        $self->group_id = $group->id;
        $self->qualification_period = 30;
        $self->repayment_period = 30;
        $self->limit_rate = 10;
        $self->fixed_late_payment = false;
        $self->late_payment_rate = true;
        $self->show_loans = false;
        $self->save();
    }
}
