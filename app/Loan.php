<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Str;

class Loan extends BaseModel
{
    protected $fillable = [
      'member_id',
      'group_id',
      'loan_amount',
    ];

    public static function hasLoan(Members $member) : bool
    {
        $loan = self::where('member_id', $member->id)->first();
        if (!$loan)
            return false;
        if ($loan->status === 'pending' || $loan->status === 'processing' || $loan->status === 'approved')
            return true;
    }

    public static function loan(Members $member)
    {
        return self::where('member_id', $member->id)->first();
    }

    public static function isQualified(Members $member) : bool
    {
        return $member->period() > LoanSetting::settings($member->group_id)->qualification_period;
    }

    public static function calculate(Members $member) : array
    {
        $settings = LoanSetting::settings($member->group_id);
        $savings = Contribution::amount($member);
        return [
            'start' =>  Carbon::now(),
            'end' => Carbon::now()->addDays($settings->repayment_period),
            'period' => $settings->repayment_period
        ];
    }

    public static function limit(Members $member) : array
    {
        $settings = LoanSetting::settings($member->group_id);
        $savings = Contribution::amount($member);
        return [
            'limit' => ((float)$savings * (float)$settings->limit_rate)/100,
            'period' => $settings->repayment_period,
            'rate' => $settings->interest_rate
        ];
    }

    public static function total($type = null, $id = null) : array
    {
        if ($type !== null){
            $loans = $type === 'GROUP' ? Loan::where('group_id', $id)->get() : Loan::where('member_id', $id)->get();
        }else{
            $loans = Loan::all();
        }

        $total = 0;
        $balance = 0;
        $paid = 0;
        foreach ($loans as $loan){
            $total += $loan->loan_amount;
            $balance += $loan->balance_amount;
            $paid += $loan->paid_amount;
        }
        return [
            'amount' => $total,
            'balance' => $balance,
            'paid' => $paid,
        ];
    }
}
