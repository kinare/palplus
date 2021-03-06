<?php

namespace App\Lib\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class HttpClient{

    public static function post($url, $params = null, $headers = []){
        $client = new Client();
        $res =  $client->request('POST', $url,[$params,$headers ] );
        return $res->getBody();
    }

    public static function get($url, $options = []){
        try{
            $client = new Client();
			$res =  $client->request('GET', $url, $options);
            return $res->getBody();
        }catch (ClientException $exception){
			dd($exception);
            return $exception;
        }

    }

    /*  todo implement other http methods PUT,Patch,delete */
}
