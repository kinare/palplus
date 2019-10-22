<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ATController;
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
     *   tags={"Auth"},
     *   summary="User  Registration",
     *   @SWG\Parameter(name="name",in="query",description="name",required=true,type="string"),
     *   @SWG\Parameter(name="email",in="query",description="email",required=true,type="string"),
     *   @SWG\Parameter(name="phone",in="query",description="phone",required=true,type="string"),
     *   @SWG\Parameter(name="country_code",in="query",description="country code",required=true,type="string"),
     *   @SWG\Parameter(name="password",in="query",description="password",required=true,type="string"),
     *   @SWG\Parameter(name="password_confirmation",in="query",description="password",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'phone' => 'required|string|unique:users',
            'country_code' => 'required|string',
            'password' => 'required|string|confirmed',
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'country_code' => $request->country_code,
            'password' => Hash::make($request->password),
            'verification_code' => $this->generateCode(),
        ]);

        $user->save();

        //send sms
        return response()->json([
            'message' => ATController::sendSms((array)$user->phone, $user->verification_code)
        ]);
    }

    public function registerEmail(Request $request)
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
     *   tags={"Auth"},
     *   summary="User login",
     *   @SWG\Parameter(name="phone",in="query",description="User phone",required=true,type="string"),
     *   @SWG\Parameter(name="password",in="query",description="User password",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public  function login(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'password' => 'required|string',
            'remember_me' => 'boolean',
        ]);

        $user = User::where('phone', $request->phone)->first();

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
                'client_id' => env('PASSPORT_CLIENT_ID'),
                'client_secret' => env('PASSPORT_CLIENT_SECRET'),
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
     *   tags={"Auth"},
     *   summary="User logout",
     *  security={
     *     {"passport": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=500, description="internal server error")
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
     *   tags={"Auth"},
     *   summary="Current user",
     *  security={
     *     {"passport": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
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
     *   tags={"Auth"},
     *   summary="activate user account",
     *   @SWG\Parameter(name="code",in="path",description="Activation code",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
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

    /**
     * Generate unique verification code
     * @return int
     */
    public function generateCode()
    {
        $code = rand(1000,9999);

        $exists = User::where('verification_code', $code)->first();

        if ($exists)
            $this->generateCode();

        return $code;

    }

}
