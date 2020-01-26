<?php

namespace App;


use Illuminate\Support\Facades\Auth;

class Wallet extends BaseModel
{
    protected $fillable = [
      'type',
      'user_id',
      'group_id',
    ];

    public function canWithdraw($amount) : bool
    {
        return (float)$this->total_balance > (float)$amount;
    }

    public static function wallet($id) : Wallet
    {
        return self::find($id);
    }

    /**
     * @param $type
     * @param $model
     * @param $currency_id
     * @throws \Exception
     */
    public static function make($type, $model, $currency_id)
    {
        try{
            $wallet = new Wallet();
            $wallet->type = $type;
            $wallet->user_id = $model instanceof User ?$model->id : null;
            $wallet->group_id =$model instanceof Group ?$model->id : null;
            $wallet->currency_id = $currency_id;
            $wallet->save();
        }catch (\Exception $exception){
            throw $exception;
        }
    }

    public static function mine()
    {
        return self::where('user_id', Auth::user()->id)->first();
    }

    public static function group($group_id)
    {
        return self::where('group_id', $group_id)->first();
    }

    public static function total(string $balance = 'total_balance', string $type = null) : float
    {
        $wallets = $type ? Wallet::whereType($type)->get() : Wallet::all();
        $total = 0;
        foreach ($wallets as $wallet){
            $total += $wallet->$balance;
        }
        return $total;
    }

    public function currencyShortDesc(){
        return Currency::find($this->currency_id)->short_description;
    }

    public static function currency(){
       return Currency::find(Wallet::mine()->currency_id)->short_description;
    }

    public function walletCurrency(){
        return  Currency::find($this->currency_id)->short_description;
    }

    public function user(){
        return User::find($this->user_id);
    }


}
