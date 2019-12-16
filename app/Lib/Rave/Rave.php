<?php


namespace App\Lib\Rave;


use App\Lib\Http\HttpClient;

class Rave
{
    public function execute($data, String $url){

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); //Post Fields
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 200);
        curl_setopt($ch, CURLOPT_TIMEOUT, 200);

        $headers = array('Content-Type: application/json');

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $request = curl_exec($ch);

        if ($request){
            return json_decode($request, true);
        }elseif (curl_error($ch)){
            return curl_error($ch);
        }

        curl_close($ch);
    }

    public function encrypt($data){
        return Encrypt::encrypt3Des(json_encode($data));
    }

}
