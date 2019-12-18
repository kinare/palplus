<?php


namespace App\Lib\Rave;


use App\GatewayTransaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class Account extends Rave
{
    public function transact(GatewayTransaction $transaction){
        $data = json_decode($transaction->payload, true);
        $res =  $this->initiate($data, 'https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/charge');

        /* cache the data for later use */
        $cache = ['req' => $data, 'res' => $res,];
        Cache::put($data['txRef'], $cache, Carbon::now()->addHours(12));

        $response = [];

        /* check for response status  */
        if (isset($res['status']) && $res['status'] === 'success'){

            //check for data status
            if ($res['data']['status'] === 'failed')
                $response = [
                    'code' => '03',
                    'message' => $res['data']['chargeResponseMessage'],
                ];

            if ($res['data']['chargeResponseCode'] === '00')
                $response = [
                    'code' => '00',
                    'message' => $res['data']['chargeResponseMessage'],
                ];

            if ($res['data']['chargeResponseCode'] === '02'){
                $response = [
                    'code' => '02',
                    'message' => $res['data']['validateInstructions'],
                ];
            }
        }else{
            return $res;
        }
    }

    public function otp($data){

        $data['flwRef'] = Cache::get($data['ref'])['res']['data']['flwRef'];
        $res = $this->validate($data,'https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/validate');
        if (isset($res['status']) && $res['status'] === 'success')
            Cache::forget($data['ref']);
        return $res;
    }

    public function confirm($data){
        $res = $this->verify($data['ref'], 'https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/verify');

        /*
            todo update wallet
        */

        return $res;
    }
}
