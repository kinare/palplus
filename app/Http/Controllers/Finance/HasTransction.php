<?php


namespace App\Http\Controllers\Finance;


trait HasTransction
{
    public function success($message = null){
        return response()->json([
            'code' => 0,
            'message' => $message,
        ],200);
    }

    public function password($message, $ref){
        return response()->json([
            'code' => 1,
            'message' => $message,
            'ref' => $ref
        ],200);
    }

    public function oneTimePassword($message , $ref){
        return response()->json([
            'code' => 2,
            'message' => $message,
            'ref' => $ref,
        ],200);
    }

    public function link($link){
        return response()->json([
            'code' => 3,
            'message' => 'Please wait as we redirect you OR follow the link to complete the transaction',
            'url' => $link,
        ],200);
    }

    public function empty($message  = null){
        return response()->json([
            'code' => 4,
            'message' => $message,
        ],404);
    }

    public function error($message  = null){
        return response()->json([
            'code' => 5,
            'message' => $message,
        ],500);
    }

    public function addInfo($arr){
        $arr['code'] = 6;
        return response()->json($arr,200);
    }
}
