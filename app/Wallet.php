<?php

namespace App;


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
}
