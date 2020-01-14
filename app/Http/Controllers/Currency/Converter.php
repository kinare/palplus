<?php

namespace App\Http\Controllers\Currency;

use App\Http\Controllers\Controller;
use App\Lib\Http\HttpClient;
use Carbon\Carbon;

class Converter extends Controller
{
    private $accessKey;
    private $api;
    private $base;
    public function __construct()
    {
        $this->accessKey = env('CC_ACCESS_KEY');
        $this->api = env('CC_API');
        $this->base = env('CC_BASE');
    }

    public static function Convert($from, $to, $amount){

        if ($from === $to)
            return [
                'amount' => round($amount, 2),
                'rate' => 1,
                'time' => Carbon::now(),
            ];


        $self = new self();
        $rates = $self->getRates($from, $to);
        dump($rates);
        $rates = (array)json_decode($rates)->quotes;
        $amount = ($amount/$rates[$self->base.$from]) * $rates[$self->base.$to] ;
        return [
            'amount' => round($amount, 2),
            'rate' => $rates,
            'time' => Carbon::now(),
        ];
    }

    public function getRates($from, $to){
        return HttpClient::get($this->buildUrl($from, $to));
    }

    public function buildUrl($from, $to){
        return $this->api.'?access_key='.$this->accessKey.'&currencies='.$from.','.$to.'&source='.$this->base;
    }
}
