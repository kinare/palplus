<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ATController;
use App\Http\Controllers\Controller;
use App\Notifications\SignupActivate;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth; 

class AuthController extends Controller
{

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
     *   @SWG\Parameter(name="email",in="query",description="email",required=false,type="string"),
     *   @SWG\Parameter(name="phone",in="query",description="phone",required=true,type="string"),
     *   @SWG\Parameter(name="currency_id",in="query",description="currency id",required=true,type="integer"),
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
            'email' => 'string|email|unique:users',
            'phone' => 'required|string|unique:users',
            'currency_id' => 'required',
            'password' => 'required|string|confirmed',
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email ?: $request->phone,
            'phone' =>$request->phone,
            'currency_id' => $request->currency_id,
            'password' => Hash::make($request->password),
            'verification_code' => $this->generateCode(),
        ]);

        $user->save();

        //send sms
        return response()->json([
            'message' => ATController::sendSms((array)$user->phone, $user->verification_code)
        ]);
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
		]);
		

		$user = User::where('phone', $request->phone)->first();
		dd($user->createToken('Yunited-the-greater-coding')->accessToken);
        if (!$user || !Hash::check($request->password, $user->password)){
            return response()->json([
                'message' => 'Login failed. Check your phone or password'
            ] , 401);

		}

        if (!$user->activated()){
            return response()->json([
                'message' => 'Please activate your account first'
            ], 401);

		}

		$form_params = [
            'grant_type' => 'password',
            'client_id' => env('PASSPORT_CLIENT_ID'),
            'client_secret' => env('PASSPORT_CLIENT_SECRET'),
            'username' => $request->phone,
            'password' => $request->password,
            'provider' => 'users',
            'scope' => '',
        ];
		$tokenRequest = Request::create(url('/').'/oauth/token', 'POST', $form_params, [], [], ['HTTP_Accept' => 'application/json'] );
		$response = app()->handle($tokenRequest);
		$response = json_decode($response->getContent(), true);
		// $response['expires_in'] = "";
		// $response['expires_in'] = \Carbon\Carbon::now()->addSecond($response['expires_in'])->toDateTimeString();
		$response = collect($response);
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
     *     {"bearer": {}},
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
     *     {"bearer": {}},
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
        $user->phone_verified = true;
        $user->save();

        return response()->json([
            'message' => 'Account successfully activated. login to continue'
        ], 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse

     * @SWG\Post(
     *   path="/auth/refresh",
     *   tags={"Auth"},
     *   summary="Refresh token",
     *   security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="refresh_token",in="query",description="token",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function refresh(Request $request)
    {
        $request->validate([
            'refresh_token' => 'string|required'
        ]);

        $form_params = [
            'grant_type' => 'refresh_token',
            'refresh_token' => $request->refresh_token,
            'client_id' => env('PASSPORT_CLIENT_ID'),
            'client_secret' => env('PASSPORT_CLIENT_SECRET'),
            'provider' => 'users',
            'scope' => '',

        ];
        $tokenRequest = Request::create(url('/').'/oauth/token', 'POST', $form_params, [], [], ['HTTP_Accept' => 'application/json'] );
        $response = app()->handle($tokenRequest);

        return $response;

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
