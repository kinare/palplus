<?php


namespace App\Lib\Rave;


use Illuminate\Support\Facades\Cache;

class Card extends Rave
{
    protected $rave;

    public function initiate(array $data)
    {
        $details = $this->encrypt($data);
        $postdata = [
            'PBFPubKey' => Config::getConfig('RAVE_PUBLIC_KEY'),
            'client' => $details,
            'alg' => '3DES-24'
        ];

        $res = $this->execute($postdata, 'https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/charge');

        Cache::put($data['txRef'], $res, 360);

        if ($res['data']['chargeResponseCode'] === '00'){
            return $res['data']['chargeResponseMessage'];
        }elseif($res['data']['chargeResponseCode'] === '02'){

            if ($res['data']['authModelUsed'] === 'PIN')
                return $res['data']['chargeResponseMessage'];

            if ($res['data']['authModelUsed'] === 'VBVSECURECODE')
                return $res['data']['authurl'];
        }
    }

    public function validate($data)
    {
        $res = $this->execute($data, 'https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/validatecharge');
        return $res;
    }
}
