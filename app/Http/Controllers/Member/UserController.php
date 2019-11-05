<?php

namespace App\Http\Controllers;

use App\Http\Resources\AccountResource;
use App\Http\Resources\GroupResource;
use App\Http\Resources\LoansResource;
use App\Http\Resources\NextOfKinResource;
use App\Http\Resources\PaymentResource;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\WalletResource;
use App\User;
use Exception;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Type;

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
     * @SWG\Get(
     *   path="/user/wallet",
     *   tags={"User"},
     *   summary="My wallet",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function wallet(Request $request)
    {
        try{
            return new WalletResource($request->user()->wallet()->get());
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @SWG\Get(
     *   path="/user/profile",
     *   tags={"User"},
     *   summary="My Profile",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function profile(Request $request)
    {
        try{
            return new ProfileResource($request->user()->profile()->get());

        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @SWG\Get(
     *   path="/user/nok",
     *   tags={"User"},
     *   summary="My Next of Kin",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function nok(Request $request)
    {
        try{
            return new NextOfKinResource($request->user()->nok()->get());

        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @SWG\Get(
     *   path="/user/groups",
     *   tags={"User"},
     *   summary="My Groups",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function groups(Request $request)
    {
        try{
            return new GroupResource($request->user()->groups()->get());

        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @SWG\Get(
     *   path="/user/transactions",
     *   tags={"User"},
     *   summary="My Transactions",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function transactions(Request $request,$type = null)
    {
        try{
            if ($type){
                return new TransactionResource($request->user()->transactions()->whereType($type)->get());
            }else{
                return new TransactionResource($request->user()->transactions()->get());
            }

        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }


    /**
     * @SWG\Get(
     *   path="/user/accounts",
     *   tags={"User"},
     *   summary="My Accounts",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function accounts(Request $request)
    {
        try{
            return new AccountResource($request->user()->accounts()->get());
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }


    /**
     * @SWG\Get(
     *   path="/user/payments",
     *   tags={"User"},
     *   summary="My Payments",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function payments(Request $request)
    {
        try{
            return new PaymentResource($request->user()->payments()->get());
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }


    /**
     * @SWG\Get(
     *   path="/user/loan",
     *   tags={"User"},
     *   summary="My Loan",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function loan(Request $request)
    {
        try{
            return new LoansResource($request->user()->loans()->get());
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }




}
