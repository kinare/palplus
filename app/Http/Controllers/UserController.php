<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function __construct()
    {
        parent::__construct(User::class, UserResource::class);
    }

    /**
     * @SWG\Get(
     *   path="/user",
     *   tags={"User"},
     *   summary="All Users List",
     *  security={
     *     {"passport": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Get(
     *   path="/user/admins",
     *   tags={"User"},
     *   summary="Admins User List",
     *  security={
     *     {"passport": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    public function admins()
    {
        try{
            return $this->response($this->model::where('is_admin', true)->get());
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }


    /**
     * @SWG\Get(
     *   path="/user/admin/make/{id}",
     *   tags={"User"},
     *   summary="Make user an admin",
     *  security={
     *     {"passport": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="User Id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    public function makeAdmin($id)
    {
        try{
            $user = $this->model::find($id);
            $user->is_admin = true;
            $user->save();
            return $this->response($user);
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @SWG\Get(
     *   path="/user/admin/loose/{id}",
     *   tags={"User"},
     *   summary="revoke user admin right",
     *  security={
     *     {"passport": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="User Id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function looseAdmin($id)
    {
        try{
            $user = $this->model::find($id);
            $user->is_admin = false;
            $user->save();
            return $this->response($user);
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @SWG\Get(
     *   path="/user/activate/{id}",
     *   tags={"User"},
     *   summary="Activate a user",
     *  security={
     *     {"passport": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="User Id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function activate($id)
    {
        try{
            $user = $this->model::find($id);
            $user->active = true;
            $user->save();
            return $this->response($user);
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @SWG\Get(
     *   path="/user/deactivate/{id}",
     *   tags={"User"},
     *   summary="Dectivate a user",
     *  security={
     *     {"passport": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="User Id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function deactivate($id)
    {
        try{
            $user = $this->model::find($id);
            $user->active = false;
            $user->save();
            return $this->response($user);
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }



}
