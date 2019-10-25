<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Resources\AdminResource;
use App\Notifications\AdminInviteNotice;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminAuthController extends Controller
{

    /**
     * @SWG\Post(
     *   path="/admin/invite",
     *   tags={"Admin Auth"},
     *   summary="Invite Admin",
     *  security={
     *     {"passport": {}},
     *   },
     *   @SWG\Parameter(name="email",in="query",description="Email Address",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function invite(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:admins'
        ]);

        $admin = new Admin([
            'email' => $request->email,
            'invitation_token' => Str::random(60)
        ]);

        $admin->save();

        $admin->notify(new AdminInviteNotice());

        return response()->json([
            'message' => 'Invitation link sent to '.$admin->email
        ], 200);
    }

    /**
     * @SWG\Post(
     *   path="/admin/validate",
     *   tags={"Admin Auth"},
     *   summary="Validate admin invitation token",
     *  security={
     *     {"passport": {}},
     *   },
     *   @SWG\Parameter(name="token",in="query",description="Invitation token",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     * @param Request $request
     * @return AdminResource|JsonResponse
     */
    public function validateToken(Request $request)
    {
        $admin = Admin::where('invitation_token', $request->token)->first();

        if (!$admin)
            return response()->json([
                'message' => 'Invalid token'
            ], 404);

        $admin->invitation_token = null;
        $admin->email_verified_at = now();
        $admin->save();

        return new AdminResource($admin);
    }

    /**
     * @SWG\Post(
     *   path="/admin/create",
     *   tags={"Admin Auth"},
     *   summary="Validate admin invitation token",
     *  security={
     *     {"passport": {}},
     *   },
     *   @SWG\Parameter(name="id",in="query",description="id",required=true,type="string"),
     *   @SWG\Parameter(name="name",in="query",description="Name",required=true,type="string"),
     *   @SWG\Parameter(name="phone",in="query",description="Phone Number",required=true,type="string"),
     *   @SWG\Parameter(name="password",in="query",description="Password",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     * @param Request $request
     * @return AdminResource|JsonResponse
     */
    public function register(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'password' => 'required',
        ]);

        $admin = Admin::find($request->id);

        if ($admin->active)
            return response()->json([
            'message' => 'Admin already exits'
            ], 400);

        $admin->fill($request->all());
        $admin->password = Hash::make($request->password);
        $admin->active = true;
        $admin->save();
        return new AdminResource($admin);
    }

    /**
     * @param Request $request
     * @return JsonResponse

     * @SWG\Post(
     *   path="/admin/login",
     *   tags={"Admin Auth"},
     *   summary="Admin login",
     *   @SWG\Parameter(name="email",in="query",description="Email Address",required=true,type="string"),
     *   @SWG\Parameter(name="password",in="query",description="Admin password",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public  function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $admin = Admin::where('email', $request->email)->firstOrFail();
        if (!$admin || !Hash::check($request->password, $admin->password))
            return response()->json([
                'message' => 'Login failed. Check your email or password'
            ], 401);

        if (!$admin->active)
            return response()->json([
                'message' => 'Please activate your account first'
            ], 401);

        $form_params = [
            'grant_type' => 'password',
            'client_id' => env('PASSPORT_CLIENT_ID'),
            'client_secret' => env('PASSPORT_CLIENT_SECRET'),
            'username' => $request->email,
            'password' => $request->password,
            'provider' => 'admins',
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
     *   path="/admin/logout",
     *   tags={"Admin Auth"},
     *   summary="Adminlogout",
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




}
