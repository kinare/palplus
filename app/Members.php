<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Members extends BaseModel
{
    protected $fillable = [
        'group_id', 'user_id', 'setting_id', 'profile_id'
    ];

    public function user()
    {
        return $this->belongsTo("App\User")->withTrashed();
    }

    public static function member($group_id)
    {
      return self::where([
            'user_id' => Auth::user()->id,
            'group_id' => $group_id
        ])->first();
    }

    public  function period() : int
    {
        return Carbon::parse($this->created_at)->diffInDays(Carbon::now(), true);
    }

    public static function approvers($group_id, $type = 'LOAN'){
        return self::where([
            'group_id' => $group_id,
            ($type === 'LOAN' ? 'loan_approver' : 'withdrawal_approver') => true,
        ])->get();
    }

    public function activate(){
        $this->active = true;
        $this->save();
    }

    public function deActivate(){
        $this->active = false;
        $this->save();
    }

}
