<?php


namespace App\Lib\Rave;


use App\GatewayTransaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class Mobile extends Rave
{
    public function transact(GatewayTransaction $transaction){
        $data = json_decode($transaction->payload, true);
        return $this->initiate($data, 'https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/charge');
    }
}
