<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PasswordResetController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminPasswordResetController extends PasswordResetController
{
    public function __construct()
    {
        parent::__construct(Admin::class);
    }

    /**
     * @SWG\Post(
     *   path="/admin/password/request",
     *   tags={"Admin Auth"},
     *   summary="Password reset request",
     *   @SWG\Parameter(name="email",in="query",description="email",required=false,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */

    /**
     * @SWG\Get(
     *   path="/admin/password/validate/{token}",
     *   tags={"Admin Auth"},
     *   summary="Validate password request token",
     *   @SWG\Parameter(name="token",in="path",description="token",required=false,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */

    /**
     * @SWG\Post(
     *   path="/admin/password",
     *   tags={"Admin Auth"},
     *   summary="Set Admin Password",
     *   @SWG\Parameter(name="email",in="query",description="email",required=false,type="string"),
     *   @SWG\Parameter(name="password",in="query",description="password",required=false,type="string"),
     *   @SWG\Parameter(name="password_confirmation",in="query",description="password confirmation",required=false,type="string"),
     *   @SWG\Parameter(name="token",in="query",description="token",required=false,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */



}
