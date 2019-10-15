<?php

namespace App\Http\Controllers;

use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\PasswordReset;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PasswordResetController extends Controller
{

    public function create(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email'
        ]);

        $user = User::whereEmail($request->email)->first();

        if (!$user)
            return response()->json([
                'message' => 'We can\'t find a user with that email address.'
            ], 404);

        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => str_random(60)
            ]
        );

        if ($user && $passwordReset)
            $user->notify(new PasswordResetRequest($passwordReset->token));

        return response()->json([
           'message' => 'we have emailed your password reset link.'
        ]);
    }

    /**
     * @param $token
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     * @throws \Exception
     */
    public  function find($token)
    {
        $passwordReset = PasswordReset::whereToken($token)->first();

        if (!$passwordReset)
            return response([
                'message' => 'This password reset token is invalid!.'
            ], 404);

        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()){
            $passwordReset->delete();
            return response()->json([
                'message' => 'This password reset token is invalid'
            ], 404);
        }
        return response()->json($passwordReset);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|confirmed',
            'token' => 'required|string',
        ]);

        $passwordRest = PasswordReset::where(
            ['token' => $request->token],
            ['email' => $request->email]
        )->first();

        if (!$passwordRest)
            return response()->json([
                'message' => 'This password reset token is invalid!.'
            ], 404);

        $user = User::whereEmail($request->email)->first();

        if (!$user)
            return response()->json([
                'message' => 'We can\'t find a user with that email'
            ], 404);

        $user->password = bcrypt($request->password);
        $user->save();

        $passwordRest->delete();

        $user->notify(new PasswordResetSuccess());

        return response()->json($user);
    }
}
