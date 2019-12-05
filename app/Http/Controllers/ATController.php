<?php

namespace App\Http\Controllers;

use AfricasTalking\SDK\AfricasTalking;

class ATController extends Controller
{
    private $at;
    private $username;
    private $key;
    public function __construct()
    {
        $this->username = env('AT_USERNAME');
        $this->key = env('AT_API_KEY');
        $this->at = new AfricasTalking($this->username, $this->key);
    }

    public static function sendSms(array $to, string $message,  string $from = null, bool $enqueue = false){
        $self = new self();
        $sms = $self->at->sms();
        $options = [
            'to' => $to,
            'message' => $message,
            'from' => $from,
            'enqueue' => $enqueue
        ];

        return $sms->send($options);
    }
}
