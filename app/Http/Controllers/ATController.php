<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AfricasTalking\SDK\AfricasTalking;
use phpDocumentor\Reflection\Types\Boolean;

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

    public static function sendSms(array $to, string $message, bool $enqueue = false, string $from = null ){
        $self = new self();
        $sms = $self->at->sms();
        $options = [
            'to' => $to,
            'message' => $message,
            'from' => $from,
            'enqueue' => true
        ];

        return $sms->send($options);
    }



}
