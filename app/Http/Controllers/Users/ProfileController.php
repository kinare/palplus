<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\BaseController;
use App\Http\Resources\ProfileResource;
use App\Profile;
use App\User;
use Exception;
use Illuminate\Http\Request;

class ProfileController extends BaseController
{
    public function __construct($model = Profile::class, $resource = ProfileResource::class)
    {
        parent::__construct($model, $resource);
    }

    /**
     * @SWG\Post(
     *   path="/profile",
     *   tags={"Profile"},
     *   summary="Update Profile",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="user_id",in="query",description="user id",required=true,type="string"),
     *   @SWG\Parameter(name="name",in="query",description="name",required=true,type="string"),
     *   @SWG\Parameter(name="email",in="query",description="email",required=false,type="string"),
     *   @SWG\Parameter(name="dob",in="query",description="Date of Birth",required=false,type="string"),
     *   @SWG\Parameter(name="gender",in="query",description="gender",required=true,type="string"),
     *   @SWG\Parameter(name="physical_address",in="query",description="physical_address",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */

    public function store(Request $request)
    {
        try{
            $model = $this->model::where('user_id', $request->user_id)->first();
            if (!$model){
                $model = new $this->model();
            }
            $model->fill($request->all());
            $model->gender = mb_strtolower($request->gender);
            $model->created_by = $request->user()->id;
            $model->save();

//            save user
            $user = User::find($request->user_id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            return $this->response($model);
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @SWG\Get(
     *   path="/profile/{id}",
     *   tags={"Profile"},
     *   summary="Retrieve Profile",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="activity id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
}
