<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SmsController extends Controller
{

    /**
     * @SWG\Post(
     *   path="/sms",
     *   tags={"SMS"},
     *   summary="Send SMS",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="phone",in="query",description="phone",required=true,type="string"),
     *   @SWG\Parameter(name="message",in="query",description="message",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function send(Request $request){
        return ATController::sendSms((array)$request->phone, $request->message);
    }
}
