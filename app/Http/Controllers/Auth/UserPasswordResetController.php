<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ATController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PasswordResetController;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\PasswordReset;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserPasswordResetController extends PasswordResetController
{
    public function __construct()
    {
        parent::__construct(User::class);
    }

    /**
     * @SWG\Post(
     *   path="/auth/password/request",
     *   tags={"Auth"},
     *   summary="Password reset request",
     *   @SWG\Parameter(name="phone",in="query",description="phone",required=false,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */

    public function create(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            ]);

//        //validate phone number
//        $phone = $request->phone[0] === '0' ? substr($request->phone, 1) : $request->phone;
//        $country_code = $request->country_code[0] !== '+'  ? '+'.$request->country_code : $request->country_code;
//        $validPhone = $country_code.$phone;

        $model = User::wherePhone($request->phone)->first();

        if (!$model)
            return response()->json([
                'message' => 'User not found.'
            ], 404);

        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $model->email],
            [
                'email' => $model->phone,
                'token' => $this->generateCode()
            ]
        );

        if ($model && $passwordReset)
            //send sms
            return response()->json([
                'message' => ATController::sendSms((array)$model->phone, $passwordReset->token),
                'token' => $passwordReset->token
            ]);
    }

    /**
     * @SWG\Get(
     *   path="/auth/password/validate/{token}",
     *   tags={"Auth"},
     *   summary="Validate password request token",
     *   @SWG\Parameter(name="token",in="path",description="token",required=false,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */


    public function find($token){
        $passwordReset = PasswordReset::where(['token' => $token])->first();
        if(!$passwordReset){
            return response()->json([
            "message" => "Verification code is invalid"
        ]);
        }
        $user  = User::wherePhone($passwordReset->email)->first();
        if($passwordReset && $user){
            return response()->json([
                "message" => "Success",
                "phone" => $$user->phone,
                'token' => $token
            ]);
        }
        return response()->json([
            "message" => "Not Found"
        ]);
    }

    /**
     * @SWG\Post(
     *   path="/auth/password",
     *   tags={"Auth"},
     *   summary="Set User Password",
     *   @SWG\Parameter(name="phone",in="query",description="phone",required=false,type="string"),
     *   @SWG\Parameter(name="password",in="query",description="password",required=false,type="string"),
     *   @SWG\Parameter(name="password_confirmation",in="query",description="password confirmation",required=false,type="string"),
     *   @SWG\Parameter(name="token",in="query",description="token",required=false,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */

    public function reset(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'password' => 'required|string|confirmed',
            'token' => 'required|string',
        ]);

        $passwordRest = PasswordReset::where(
            ['token' => $request->token],
            ['email' => $request->phone]
        )->first();

        if (!$passwordRest)
            return response()->json([
                'message' => 'This password reset token is invalid!.'
            ], 404);

        $model = User::wherePhone($request->phone)->first();

        if (!$model)
            return response()->json([
                'message' => 'No user found'
            ], 404);

        $model->password = Hash::make($request->password);
        $model->save();
        $passwordRest->delete();

        //send sms
        return response()->json([
            'message' => ATController::sendSms((array)$model->phone, 'successfully reset password')
        ]);
    }

    /**
     * Generate unique verification code
     * @return int
     */
    public function generateCode()
    {
        $code = rand(10000,99999);
        $exists = User::where('verification_code', $code)->first();
        if ($exists)
            $this->generateCode();
        return $code;
    }

}
