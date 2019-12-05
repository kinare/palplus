<?php

namespace App\Http\Controllers\Http;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class HttpClient extends Controller
{
    public static function post($url, $params = null){
        $client = new Client();
        $res =  $client->request('POST', $url, $params);
        return $res->getBody();
    }

    public static function get($url){
        try{
            $client = new Client();
            $res =  $client->request('GET', $url);
            return $res->getBody();
        }catch (ClientException $exception){
            return $exception;
        }

    }

    /*  todo implement other http methods PUT,Patch,delete */
}
