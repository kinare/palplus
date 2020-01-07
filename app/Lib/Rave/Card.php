<?php


namespace App\Lib\Rave;


use App\GatewayTransaction;
use App\Http\Controllers\Finance\HasTransction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class Card extends Rave
{
    use HasTransction;

    protected $rave;

    public function transact(GatewayTransaction $transaction){
        $data = json_decode($transaction->payload, true);
        $res =  $this->initiate($data, 'https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/charge');

        /* cache the data for later use */
        $cache = ['req' => $data, 'res' => $res];
        Cache::put($data['txRef'], $cache, Carbon::now()->addHours(12));

        $response = [];

        /* check for response status  */
        if (isset($res['status']) && $res['status'] === 'success'){

            /* check for suggested auth */
            if (isset($res['message']) && isset($res['data']['suggested_auth'])){
                switch($res['data']['suggested_auth']){
                    case 'PIN':
                        /* request pin set pin and suggested auth */
                        return $this->oneTimePassword($res['data']['suggested_auth'].' required', $data['txRef']);
                       break;
                    case 'NOAUTH_INTERNATIONAL':
                        /* Set billing address * */
                        return $this->addInfo([
                            'message' => 'add billing address',
                            'ref' => $data['txRef']
                        ]);

                        break;
                    case 'AVS_VBVSECURECODE':
                        /* Set billing address * */
                        return $this->addInfo([
                            'message' => 'add billing address',
                            'ref' => $data['txRef']
                        ]);
                }
                return $response;
            }
        }

        /* check for ressponse errors */
        if (isset($res['status']) && $res['status'] === 'error'){
            return $res;
        }

        /*  check response for validation */
        if ($res['data']['chargeResponseCode'] === '00'){
            /* 00 transaction successful */
            return $this->success($res['data']['chargeResponseMessage']);

        }elseif($res['data']['chargeResponseCode'] === '02'){

            /* 02 transaction needs validation */

            if ($res['data']['authModelUsed'] === 'PIN')
                /* 00 transaction successful */
                return $this->oneTimePassword($res['data']['chargeResponseMessage'], $data['txRef']);


            if ($res['data']['authModelUsed'] === 'VBVSECURECODE')
                return $this->link($res['data']['authurl']);

        }

        return $response;
    }

    public function setPin($data){
        $details = Cache::get($data['ref'])['req'];
        $details['suggested_auth'] = 'PIN';
        $details['pin'] = $data['pin'];
        $res = $this->initiate($details, 'https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/charge');

        if ($res['status'] === 'success'){
            return $this->success($res['data']['chargeResponseMessage']);
        }

        return $res;
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
