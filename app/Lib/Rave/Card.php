<?php


namespace App\Lib\Rave;


use App\GatewayTransaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class Card extends Rave
{
    protected $rave;

    public function transact(GatewayTransaction $transaction){
        $data = json_decode($transaction->payload, true);
        return $this->initiate($data);
    }

    public function initiate($data)
    {
        /* encrypt request data */
        $details = $this->encrypt($data);

        /* prepare postdata */
        $postdata = [
            'PBFPubKey' => Config::getConfig('RAVE_PUBLIC_KEY'),
            'client' => $details,
            'alg' => '3DES-24'
        ];

        /* Execute request */
        $res = $this->execute($postdata, 'https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/charge');

        /* cache the data for later use */
        $cache = [
            'req' => $data,
            'res' => $res,
        ];
        Cache::put($data['txRef'], $cache, Carbon::now()->addHours(12));

        $response = [];


        /* check for response status  */
        if (isset($res['status']) && $res['status'] === 'success'){

            /* check for suggested auth */
            if (isset($res['message']) && isset($res['data']['suggested_auth'])){
                switch($res['data']['suggested_auth']){
                    case 'PIN':
                        /* request pin set pin and suggested auth */
                        $response = [
                            'code' => '03',
                            'message' => $res['message'],
                            'desc' => 'add pin and suggested auth',
                            'model' => $res['data']['suggested_auth'],
                            'ref' => $data['txRef'],
                        ];
                       break;
                    case 'NOAUTH_INTERNATIONAL':
                        /* Set billing address * */
                        $response = [
                            'code' => '03',
                            'message' => $res['message'],
                            'desc' => 'add billing address',
                            'model' => $res['data']['suggested_auth'],
                            'ref' => $data['txRef']
                        ];
                        break;
                    case 'AVS_VBVSECURECODE':
                        /* Set billing address * */
                        $response = [
                            'code' => '03',
                            'message' => $res['message'],
                            'desc' => 'add billing address',
                            'model' => $res['data']['suggested_auth'],
                            'ref' => $data['txRef']
                        ];
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

            $response = [
                'code' => $res['data']['chargeResponseCode'],
                'message' => $res['data']['chargeResponseMessage'],
                'type' => $res['data']['paymentType'],
                'txref' => $data['txRef'],
            ];

        }elseif($res['data']['chargeResponseCode'] === '02'){

            /* 02 transaction needs validation */

            if ($res['data']['authModelUsed'] === 'PIN')
                $response = [
                    'code' => $res['data']['chargeResponseCode'],
                    'message' => $res['data']['chargeResponseMessage'],
                    'model' => $res['data']['authModelUsed'],
                    'type' => $res['data']['paymentType'],
                    'txref' => $data['txRef'],
                ];


            if ($res['data']['authModelUsed'] === 'VBVSECURECODE')
                $response = [
                    'code' => $res['data']['chargeResponseCode'],
                    'message' => $res['data']['chargeResponseMessage'],
                    'model' => $res['data']['authModelUsed'],
                    'type' => $res['data']['paymentType'],
                    'url' => $res['data']['authurl'],
                    'txref' => $data['txRef'],
                ];
        }

        return $response;
    }

    public function setPin($data){
        $details = Cache::get($data['ref'])['req'];
        $details['suggested_auth'] = 'PIN';
        $details['pin'] = $data['pin'];
        return $this->initiate($details);
    }

    public function validate($data)
    {
        $data = [
            'PBFPubKey' => Config::getConfig('RAVE_PUBLIC_KEY'),
            'transaction_reference' => Cache::get($data['ref'])['res']['data']['flwRef'],
            'otp' => $data['otp']
        ];

        $res = $this->execute($data, 'https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/validatecharge');

        if (isset($res['status']) && $res['status'] === 'success')
            Cache::forget($data['ref']);

        return $res;
    }
}
