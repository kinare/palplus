<?php

namespace App\Http\Controllers\Currency;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Http\HttpClient;
use Illuminate\Http\Request;

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
        $self = new self();
        $rates = $self->getRates($from, $to);
        $rates = (array)json_decode($rates)->quotes;
        $amount = ($amount/$rates[$self->base.$from]) * $rates[$self->base.$to] ;
        return round($amount, 2);
    }

    public function getRates($from, $to){
        return HttpClient::get($this->builUrl($from, $to));
    }

    public function builUrl($from, $to){
        return $this->api.'?access_key='.$this->accessKey.'&currencies='.$from.','.$to.'&source='.$this->base;
    }
}
