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

    public function password($message = null){
        return response()->json([
            'code' => 1,
            'message' => $message,
        ],200);
    }

    public function otp($message  = null){
        return response()->json([
            'code' => 2,
            'message' => $message,
        ],200);
    }

    public function link($link){
        return response()->json([
            'code' => 3,
            'message' => 'finish transaction through the link provided',
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
}
