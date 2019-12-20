<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends BaseModel
{
    protected $fillable = [
        'group_id',
        'member_id',
        'amount',
    ];

    public static function limit($type, $group_id) : array
    {
        $setting = GroupSetting::where('group_id', $group_id)->first();
        $member = Members::member($group_id);
        $contributions = Contribution::total($member) - Withdrawal::total($member);
        $loan = (float)Loan::total($member)['balance'];
        $leave = (float)$setting->leaving_group_fee;
        return [
            'contributions' => $contributions,
            'loans' => $loan,
            'leave_group_fee' =>$setting->leaving_group_fee,
            'total' => $contributions - ($loan + $leave),
        ];
    }

    public static function withdraw(Members $members, $amount){
        $withdrawal = new Withdrawal();
        $withdrawal->code = Str::random(30).Carbon::now()->timestamp;
        $withdrawal->group_id = $members->group_id;
        $withdrawal->member_id = $members->id;
        $withdrawal->amount = $amount;
        $withdrawal->save();
        return $withdrawal;
    }

    public static function total(Model $model){
        if ($model instanceof Members)
            $withdrawals = self::whereMemberId($model->id)->get();

        if ($model instanceof Group)
            $contributions = self::whereGroupId($model->id)->get();

        if (!$model)
            $contributions = self::all();

        $total = 0;
        foreach ($contributions as $contribution){
            $total += (float)$contribution->amount;
        }
        return $total;
    }
}
