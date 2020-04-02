<?php


namespace App\Lib\Rave;


use App\GatewayTransaction;
use App\Http\Controllers\Finance\HasTransction;
use App\Lib\Http\HttpClient;

class Transfer extends Rave
{
    use HasTransction;

    public function send(GatewayTransaction $transaction){
        $data = json_decode($transaction->payload);
        $data->seckey = Config::getConfig('RAVE_SECRET_KEY');
        $res = $this->execute($data, env('RAVE_ENDPOINT').'/v2/gpx/transfers/create');

        if ($res['status'] === 'success')
            return $this->success($res['message']);

        return $this->error($res['message']);
    }

    public static function transferCountries(){
        return collect(
            [
                'data' => [
                    ['country' => 'Nigeria', 'code' => 'NG'],
                    ['country' => 'Ghana', 'code' => 'GH'],
                    ['country' => 'Kenya', 'code' => 'KE'],
                    ['country' => 'Uganda', 'code' => 'UG'],
                    ['country' => 'South Africa', 'code' => 'ZA'],
                    ['country' => 'Tanzania', 'code' => 'TZ'],
                ]
            ]
        );
    }

    public static function getBanksForTransfer($countryCode){
       $url = env('RAVE_ENDPOINT').'/v2/banks/'.$countryCode.'?public_key='.Config::getConfig('RAVE_PUBLIC_KEY');
       $res = HttpClient::get($url, ['headers' => ['Content-Type' => 'application/json']]);
       $res = json_decode($res, true);
       return $res['data'];
    }
}
