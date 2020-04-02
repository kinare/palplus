<?php


namespace App\Lib\Rave;


use App\GatewayTransaction;
use App\Http\Controllers\Finance\HasTransction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class Mobile extends Rave
{
    use HasTransction;

    public function transact(GatewayTransaction $transaction){
        $data = json_decode($transaction->payload, true);
        $res = $this->initiate($data, env('RAVE_ENDPOINT').'/flwv3-pug/getpaidx/api/charge');
        if ($res['status'] === 'error')
            return $this->error($res['message']);

        if ($res['status'] === 'success')
            return $this->success('You will receive a prompt to pay on you mobile');
    }
}
