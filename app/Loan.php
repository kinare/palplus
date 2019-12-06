<?php

namespace App;

use App\Http\Controllers\AccountingController;
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
        $loan = self::where(['member_id' => $member->id, 'group_id' => $member->group_id])->orderBy('created_at', 'desc')->first();
        if (!$loan)
            return false;

        if ($loan->status === 'pending' || $loan->status === 'processing' || $loan->status === 'approved')
            return true;

        return false;
    }

    public static function loan(Members $member)
    {
        return self::where('member_id', $member->id)->first();
    }

    public static function isQualified(Members $member) : bool
    {
        return $member->period() >= (int)LoanSetting::settings($member->group_id)->qualification_period;
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

    public static function pay(Loan $loan, $amount) : self
    {
        //Get Wallets
        $wallet = Wallet::mine();
        $groupWallet = Wallet::group($loan->group_id);

        //validate wallet
        if (!$wallet->canWithdraw($amount))
            return response()->json([
                'message' => 'Insufficient funds balance: '.$wallet->total_balance
            ], 403);

        //Transact
        AccountingController::transact(
            $wallet,
            $groupWallet,
            $amount,
            [
                'model' => Loan::class,
                'model_id' => $loan->id,
                'description' => 'Loan Re-payment',
                'account' => '',
                'transaction_code' => Str::random(10).Carbon::now()->timestamp,
            ]
        );

        //Todo Handle paying more than loan amount i.e return to user wallet

        $loan->balance_amount = (float)$loan->balance_amount - (float)$amount;
        $loan->paid_amount = (float)$loan->paid_amount + (float)$amount;
        if ($loan->balance_amount <= 0) $loan->status = 'cleared';
        $loan->save();

        return $loan;
    }
}
