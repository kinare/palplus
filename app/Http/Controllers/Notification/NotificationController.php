<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\BaseController;
use App\Http\Resources\NotificationResource;
use App\Notification;

class NotificationController extends BaseController
{
    public function __construct($model = Notification::class, $resource = NotificationResource::class)
    {
        parent::__construct($model, $resource);
	}
	

	 /**
     * @SWG\Get(
     *   path="/notification",
     *   tags={"Notification"},
     *   summary="Retrieve Current User Notifications",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
	  public function index(){
		try{
            return NotificationResource::collection(Notification::where('user_id', auth()->user()->id)->get());
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
		}

    /**
     * @SWG\Get(
     *   path="/notification/read/{id}",
     *   tags={"Notification"},
     *   security={
     *     {"bearer": {}},
     *   },
     *   summary="Read notification",
     *   @SWG\Parameter(name="id",in="path",description="Notification id",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function read($id){
        $notice = Notification::find($id);
        $notice->read();

        return response()->json([
            'message' => 'Notification read success'
        ], 200);
	}
	

	// public static function contribute($type,  $amount){

	// }
}
