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
 *     {"bearer": {}},
 *   },
 *   @SWG\Response(response=200, description="Success"),
 *   @SWG\Response(response=400, description="Not found"),
 *   @SWG\Response(response=500, description="internal server error")
 *
 * )
 */

    /**
     * @SWG\Get(
     *   path="/user/{id}",
     *   tags={"User"},
     *   summary="Retrieve User",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="User Id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */


    /**
     * @SWG\Get(
     *   path="/user/activate/{id}",
     *   tags={"User"},
     *   summary="Activate a user",
     *  security={
     *     {"bearer": {}},
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
     *     {"bearer": {}},
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

    /**
     * @SWG\Patch(
     *   path="/user/{id}",
     *   tags={"User"},
     *   summary="Update a user",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="name",in="path",description="name",required=true,type="string"),
     *   @SWG\Parameter(name="email",in="path",description="name",required=true,type="string"),
     *   @SWG\Parameter(name="country_code",in="path",description="name",required=true,type="string"),
     *   @SWG\Parameter(name="phone",in="path",description="name",required=true,type="string"),
     *   @SWG\Parameter(name="password",in="path",description="password",required=false,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/user/{id}",
     *   tags={"User"},
     *   summary="Soft delete a user",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/user/{id}/force",
     *   tags={"User"},
     *   summary="Force delete a user",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */


}
