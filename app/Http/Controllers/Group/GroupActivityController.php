<?php

namespace App\Http\Controllers\Group;

use App\GroupActivity;
use App\Http\Controllers\BaseController;
use App\Http\Resources\GroupActivityResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravolt\Avatar\Facade as Avatar;

class GroupActivityController extends BaseController
{
    public function __construct()
    {
        parent::__construct(GroupActivity::class, GroupActivityResource::class);
    }
    /**
     * @SWG\Get(
     *   path="/activity",
     *   tags={"Activity"},
     *   summary="Retrieve Activity",
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
     * @SWG\Post(
     *   path="/activity",
     *   tags={"Activity"},
     *   summary="Create Activity",
     *   produces={"application/json"},
     *   consumes={"multipart/form-data"},
     *   security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="group_id",in="formData",description="Group id",required=true,type="string"),
     *   @SWG\Parameter(name="activity_type_id",in="formData",description="Activity type id",required=true,type="string"),
     *   @SWG\Parameter(name="name",in="formData",description="name",required=true,type="string"),
     *   @SWG\Parameter(name="description",in="formData",description="description",required=true,type="string"),
     *   @SWG\Parameter(name="avatar",in="formData",description="avatar",required=false,type="file"),
     *   @SWG\Parameter(name="itinerary",in="formData",description="itinerary",required=false,type="string"),
     *   @SWG\Parameter(name="start_date",in="formData",description="start date",required=true,type="string"),
     *   @SWG\Parameter(name="end_date",in="formData",description="end date",required=true,type="string"),
     *   @SWG\Parameter(name="cut_off_date",in="formData",description="cut off date",required=false,type="string"),
     *   @SWG\Parameter(name="contacts",in="formData",description="contacts",required=false,type="string"),
     *   @SWG\Parameter(name="slots",in="formData",description="slots",required=false,type="integer"),
     *   @SWG\Parameter(name="featured",in="formData",description="featured",required=false,type="integer"),
     *   @SWG\Parameter(name="booking_fee",in="formData",description="booking fee",required=false,type="integer"),
     *   @SWG\Parameter(name="installments",in="formData",description="installments",required=false,type="integer"),
     *   @SWG\Parameter(name="no_of_installments",in="formData",description="no_of_installments",required=false,type="integer"),
     *   @SWG\Parameter(name="booking_fee_amount",in="formData",description="booking_fee_amount",required=false,type="number"),
     *   @SWG\Parameter(name="instalment_amount",in="formData",description="instalment_amount",required=false,type="number"),
     *   @SWG\Parameter(name="total_cost",in="formData",description="total_cost",required=false,type="number"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    public function store(Request $request)
    {
        try{
            $model = new $this->model();
            $data = $request->all();
            $model->fill($data);
            $model->created_by = $request->user()->id;
            $model->save();

            if ($request->hasFile('avatar')){
                $attachment = [];
                $attachment['file'] = $request->file('avatar');
                $attachment['filename'] = $request->file('avatar')->getClientOriginalName();

                if (Storage::disk('avatars')->exists("activities/" . $model->id . '/' . $attachment['filename']))
                    $attachment['filename'] = uniqid().'.'.$attachment['file']->getClientOriginalExtension();

                Storage::disk('avatars')->put("activities/".$model->id.'/'.$attachment['filename'], file_get_contents($attachment['file']));
                $model->avatar = $attachment['filename'];
            }else{
                $avatar = Avatar::create($model->name)->getImageObject()->encode('png');
                Storage::disk('avatars')->put("activities/".$model->id.'/avatar.png', (string) $avatar);
                $model->avatar =  'avatar.png';
            }

            $model->save();
            return $this->response($model);
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }

    }


    /**
     * @SWG\Patch(
     *   path="/activity/{id}",
     *   tags={"Activity"},
     *   summary="Update Activity",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Activity id",required=true,type="string"),
     *   @SWG\Parameter(name="group_id",in="formData",description="Group id",required=true,type="string"),
     *   @SWG\Parameter(name="activity_type_id",in="formData",description="Activity type id",required=true,type="string"),
     *   @SWG\Parameter(name="name",in="formData",description="name",required=true,type="string"),
     *   @SWG\Parameter(name="description",in="formData",description="description",required=true,type="string"),
     *   @SWG\Parameter(name="avatar",in="formData",description="avatar",required=false,type="file"),
     *   @SWG\Parameter(name="itinerary",in="formData",description="itinerary",required=false,type="string"),
     *   @SWG\Parameter(name="start_date",in="formData",description="start date",required=true,type="string"),
     *   @SWG\Parameter(name="end_date",in="formData",description="end date",required=true,type="string"),
     *   @SWG\Parameter(name="cut_off_date",in="formData",description="cut off date",required=false,type="string"),
     *   @SWG\Parameter(name="contacts",in="formData",description="contacts",required=false,type="string"),
     *   @SWG\Parameter(name="slots",in="formData",description="slots",required=false,type="integer"),
     *   @SWG\Parameter(name="featured",in="formData",description="featured",required=false,type="integer"),
     *   @SWG\Parameter(name="booking_fee",in="formData",description="booking fee",required=false,type="integer"),
     *   @SWG\Parameter(name="installments",in="formData",description="installments",required=false,type="integer"),
     *   @SWG\Parameter(name="no_of_installments",in="formData",description="no_of_installments",required=false,type="integer"),
     *   @SWG\Parameter(name="booking_fee_amount",in="formData",description="booking_fee_amount",required=false,type="number"),
     *   @SWG\Parameter(name="instalment_amount",in="formData",description="instalment_amount",required=false,type="number"),
     *   @SWG\Parameter(name="total_cost",in="formData",description="total_cost",required=false,type="number"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Get(
     *   path="/activity/{id}",
     *   tags={"Activity"},
     *   summary="Retrieve Activity",
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

    /**
     * @SWG\Delete(
     *   path="/activity/{id}",
     *   tags={"Activity"},
     *   summary="Delete Activity",
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

    /**
     * @SWG\Delete(
     *   path="/activity/{id}/force",
     *   tags={"Activity"},
     *   summary="Force delete Activity",
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
