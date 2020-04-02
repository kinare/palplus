<?php


namespace App\Lib\Rave;


use App\GatewayTransaction;
use App\Http\Controllers\Finance\HasTransction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class Account extends Rave
{
    use HasTransction;

    public function transact(GatewayTransaction $transaction){
        $data = json_decode($transaction->payload, true);
        $res =  $this->initiate($data, env('RAVE_ENDPOINT').'/flwv3-pug/getpaidx/api/charge');

        /* cache the data for later use */
        $cache = ['req' => $data, 'res' => $res,];
        Cache::put($data['txRef'], $cache, Carbon::now()->addHours(12));


        /* check for response status  */
        if ($res['status'] === 'error'){
            return $this->error($res['message']);
        }

        // todo process on success

        return $res;

    }

    public function otp($data){

        $data['flwRef'] = Cache::get($data['ref'])['res']['data']['flwRef'];
        $res = $this->validate($data,env('RAVE_ENDPOINT').'/flwv3-pug/getpaidx/api/validate');
        if (isset($res['status']) && $res['status'] === 'success')
            Cache::forget($data['ref']);
        return $res;
    }

    public function confirm($data){
        $res = $this->verify($data['ref'], env('RAVE_ENDPOINT').'/flwv3-pug/getpaidx/api/verify');

        /*
            todo update wallet
        */

        return $res;
    }
}
