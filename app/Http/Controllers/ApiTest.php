<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Integration\Rave\Transfer;
use App\Lib\Rave\Card;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ApiTest extends Controller
{
    /**
     * @SWG\Get(
     *   path="/test/rave/card",
     *   tags={"Test"},
     *   summary="Test Rave card",
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function raveCardTest(){
        $details = [
            'PBFPubKey' => env('RAVE_PUBLIC_KEY'),
            'cardno' => '5531886652142950',
            'currency' => 'NGN',
            'country' => 'NG',
            'cvv' => '564',
            'amount' => '10',
            'expiryyear' => '22',
            'expirymonth' => '09',
            'suggested_auth' => 'pin',
            'pin' => '3310',
            'email' => 'tester@flutter.co',
            'IP' => '103.238.105.185',
            'txRef' => 'MXX-ASC-4578',
            'device_fingerprint' => '69e6b7f0sb72037aa8428b70fbe03986c'
        ];

        $card = new Card();
        return $card->initiate($details);
    }

    /**
     * @SWG\Get(
     *   path="/test/rave/validate-card",
     *   tags={"Test"},
     *   summary="Validate Rave card",
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function validateCard(Request $request){
        $data = [
            'PBFPubKey' => env('RAVE_PUBLIC_KEY'),
            'transaction_reference' => Cache::get('MXX-ASC-4578')['data']['flwRef'],
            'otp' => '12345'
        ];

        $card = new Card();
        return $card->validate($data);
    }
}
