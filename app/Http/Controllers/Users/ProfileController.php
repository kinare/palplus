<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\BaseController;
use App\Http\Resources\ProfileResource;
use App\Profile;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravolt\Avatar\Facade as Avatar;

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
     *  produces={"application/json"},
     *  consumes={"multipart/form-data"},
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="name",in="formData",description="name",required=false,type="string"),
     *   @SWG\Parameter(name="email",in="formData",description="email",required=false,type="string"),
     *   @SWG\Parameter(name="dob",in="formData",description="Date of Birth",required=false,type="string"),
     *   @SWG\Parameter(name="gender",in="formData",description="gender",required=false,type="string"),
     *   @SWG\Parameter(name="physical_address",in="formData",description="physical_address",required=false,type="string"),
     *   @SWG\Parameter(name="avatar",in="formData",description="profile photo",required=false,type="file"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */

    public function store(Request $request)
    {
        try{
            $model = $this->model::where('user_id', $request->user()->id)->first();
            if (!$model){
                $model = new $this->model();
            }
            $model->fill($request->all());
            $model->gender = mb_strtolower($request->gender);
            $model->created_by = $request->user()->id;
            $model->user_id = $request->user()->id;

            if ($request->hasFile('avatar')){
                $attachment = [];
                $attachment['file'] = $request->file('avatar');
                $attachment['filename'] = $request->file('avatar')->getClientOriginalName();

                if (Storage::exists("profiles/" . $request->user()->id . '/' . $attachment['filename']))
                    $attachment['filename'] = uniqid().'.'.$attachment['file']->getClientOriginalExtension();

                Storage::disk('avatars')->put("profiles/".$request->user()->id.'/'.$attachment['filename'], file_get_contents($attachment['file']));
                $model->avatar = $attachment['filename'];
            }else{
                $avatar = Avatar::create($model->name)->getImageObject()->encode('png');
                Storage::disk('avatars')->put("profiles/".$request->user()->id.'/avatar.png', (string) $avatar);
                $model->avatar =  'avatar.png';
            }

            $model->save();

//            save user
            $user = User::find($request->user()->id);
            $user->fill($request->all());
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
     *   @SWG\Parameter(name="id",in="path",description="proffile id",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
}
