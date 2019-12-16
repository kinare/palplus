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

        $details = $this->getCard();
        $details['PBFPubKey'] = env('RAVE_PUBLIC_KEY');
        $details['amount'] = '10';
        $details['IP'] = '103.238.105.185';
        $details['txRef'] = 'MXX-ASC-4578';
        $details['device_fingerprint'] = '69e6b7f0sb72037aa8428b70fbe03986c';
        $details['amount'] = '3310';

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

    public function getCard(){
        return [
            'cardno' => '5258589130149016',
            'currency' => 'NGN',
            'country' => 'NG',
            'cvv' => '887',
            'expiryyear' => '20',
            'expirymonth' => '11',
            'email' => 'tester@flutter.co',
        ];
    }
}
