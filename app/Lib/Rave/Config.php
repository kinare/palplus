<?php


namespace App\Lib\Rave;


class Config
{
    protected $config;

    public function __construct()
    {
        $this->config = [
            'RAVE_PUBLIC_KEY' => env('RAVE_PUBLIC_KEY'),
            'RAVE_SECRET_KEY' => env('RAVE_SECRET_KEY'),
            'RAVE_TITLE' => env('RAVE_TITLE'),
            'RAVE_ENVIRONMENT' => env('RAVE_ENVIRONMENT'),
            'RAVE_LOGO' => env('RAVE_LOGO'),
            'RAVE_PREFIX' => env('RAVE_PREFIX'),
            'RAVE_SECRET_HASH' => env('RAVE_SECRET_HASH'),
        ];
    }

    public static function getConfigs(){
        $self = new self();
        return $self->config;
    }

    public static function getConfig(String $key){
        $self = new self();
        return $self->config[$key];
    }

    public static function setConfig($key, $value){
        $self = new self();
        $self->config[$key] = $value;
        return $self->config;
    }
}
