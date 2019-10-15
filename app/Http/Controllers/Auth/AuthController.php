<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\SignupActivate;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    use PasswordResetTrait;

    /**
     * @param Request $request
     * @return JsonResponse
     *
     *
     * @SWG\Post(
     *   path="/auth/register",
     *   summary="User Registration",
     *   @SWG\Parameter(name="name",in="query",description="name",required=true,type="string"),
     *   @SWG\Parameter(name="email",in="query",description="email",required=true,type="string"),
     *   @SWG\Parameter(name="password",in="query",description="password",required=true,type="string"),
     *   @SWG\Parameter(name="password_confirmation",in="query",description="password",required=true,type="string"),
     *   @SWG\Response(response=200, description="login successful"),
     *   @SWG\Response(response=401, description="Login Failed"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */


    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);


        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'verification_code' => Str::random(60),
        ]);

        $user->save();

        $user->notify(new SignupActivate($user));

        return response()->json([
            'message' => 'Successfully registered'
        ], 201);
    }

    /**
     * @param Request $request
     * @return JsonResponse

     * @SWG\Post(
     *   path="/auth/login",
     *   summary="User login",
     *   @SWG\Parameter(name="email",in="query",description="User email",required=true,type="string"),
     *   @SWG\Parameter(name="password",in="query",description="User password",required=true,type="string"),
     *   @SWG\Response(response=200, description="login successful"),
     *   @SWG\Response(response=401, description="Login Failed"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public  function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password))
            return response()->json([
                'message' => 'Login failed. Check your email or password'
            ], 401);

        if (!$user->activated())
            return response()->json([
                'message' => 'Please activate your account first'
            ], 401);

            $form_params = [
                'grant_type' => 'password',
                'client_id' => 2,
                'client_secret' => 'mJHChg5f96LH50S3BI55L4YWNNrjyGhtgC19uEwW',
                'username' => $request->email,
                'password' => $request->password,
                'scope' => '',
            ];
            $tokenRequest = Request::create(url('/').'/oauth/token', 'POST', $form_params, [], [], ['HTTP_Accept' => 'application/json'] );
            $response = app()->handle($tokenRequest);
            return $response;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @SWG\Get(
     *   path="/auth/logout",
     *   summary="User logout",
     *  security={
     *     {"passport": {}},
     *   },
     *   @SWG\Response(response=200, description="logout successful"),
     *
     * )
     *
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ], 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @SWG\Get(
     *   path="/auth/user",
     *   summary="Current user",
     *  security={
     *     {"passport": {}},
     *   },
     *   @SWG\Response(response=200, description="User object"),
     *
     * )
     */
    public function user(Request $request)
    {
        return response()->json($request->user(), 200);
    }

    /**
     * @param $token
     * @return Builder|Model|JsonResponse|object|null
     *
     *  @SWG\Get(
     *   path="/auth/activate/{code}",
     *   summary="activate user account",
     *   @SWG\Parameter(name="code",in="path",description="Activation Code",required=true,type="string"),
     *   @SWG\Response(response=200, description="Activation Successfull"),
     *
     * )
     */
    public function activate($code)
    {
        $user = User::where('verification_code', $code)->first();

        if (!$user){
            return response()->json([
                'message' => 'Invalid activation code.'
            ], 404);
        }

        $user->active = true;
        $user->verification_code = '';
        $user->save();

        return response()->json([
            'message' => 'Account successfully activated. login to continue'
        ], 200);
    }

}
