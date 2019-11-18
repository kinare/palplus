<?php

namespace App;

class LoanSetting extends BaseModel
{
    protected $fillable = [
        'group_id',
        'qualification_period',
        'repayment_period',
        'limit_rate',
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
}
