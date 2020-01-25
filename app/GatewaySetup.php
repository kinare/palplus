<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GatewaySetup extends BaseModel
{
    protected $fillable =[
      'type',
      'gateway',
      'rate',
      'active'
    ];

    public static function getSetup($gateway, $type){
        return self::where([
            'type' => $type,
            'gateway' => $gateway
        ])->first();
    }

    public function getTransactionFee($amount){
        return ((float)$this->rate * (float)$amount)/100;
    }
}
