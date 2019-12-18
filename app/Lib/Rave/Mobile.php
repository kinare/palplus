<?php


namespace App\Lib\Rave;


use App\GatewayTransaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class Mobile extends Rave
{
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

        return $res;
    }
}
