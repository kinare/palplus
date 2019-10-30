<?php

namespace App\Http\Controllers\Group;

use App\GroupActivity;
use App\Http\Controllers\BaseController;
use App\Http\Resources\GroupActivityResource;
use Illuminate\Http\Request;

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
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="group_id",in="query",description="Group id",required=true,type="string"),
     *   @SWG\Parameter(name="activity_type_id",in="query",description="Activity type id",required=true,type="string"),
     *   @SWG\Parameter(name="name",in="query",description="name",required=true,type="string"),
     *   @SWG\Parameter(name="description",in="query",description="description",required=true,type="string"),
     *   @SWG\Parameter(name="itinerary",in="query",description="description",required=true,type="string"),
     *   @SWG\Parameter(name="start_date",in="query",description="start date",required=true,type="string"),
     *   @SWG\Parameter(name="end_date",in="query",description="end date",required=true,type="string"),
     *   @SWG\Parameter(name="cut_off_date",in="query",description="cut off date",required=true,type="string"),
     *   @SWG\Parameter(name="contacts",in="query",description="contacts",required=true,type="string"),
     *   @SWG\Parameter(name="slots",in="query",description="contacts",required=true,type="integer"),
     *   @SWG\Parameter(name="featured",in="query",description="contacts",required=true,type="boolean"),
     *   @SWG\Parameter(name="booking_fee",in="query",description="booking fee",required=true,type="boolean"),
     *   @SWG\Parameter(name="installments",in="query",description="installments",required=true,type="boolean"),
     *   @SWG\Parameter(name="booking_fee_amount",in="query",description="booking_fee_amount",required=true,type="number"),
     *   @SWG\Parameter(name="instalment_amount",in="query",description="instalment_amount",required=true,type="number"),
     *   @SWG\Parameter(name="total_cost",in="query",description="total_cost",required=true,type="number"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */


    /**
     * @SWG\Patch(
     *   path="/activity/{id}",
     *   tags={"Activity"},
     *   summary="Update Activity",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="group_id",in="query",description="Group id",required=true,type="string"),
     *   @SWG\Parameter(name="activity_type_id",in="query",description="Activity type id",required=true,type="string"),
     *   @SWG\Parameter(name="name",in="query",description="name",required=true,type="string"),
     *   @SWG\Parameter(name="description",in="query",description="description",required=true,type="string"),
     *   @SWG\Parameter(name="itinerary",in="query",description="description",required=true,type="string"),
     *   @SWG\Parameter(name="start_date",in="query",description="start date",required=true,type="string"),
     *   @SWG\Parameter(name="end_date",in="query",description="end date",required=true,type="string"),
     *   @SWG\Parameter(name="cut_off_date",in="query",description="cut off date",required=true,type="string"),
     *   @SWG\Parameter(name="contacts",in="query",description="contacts",required=true,type="string"),
     *   @SWG\Parameter(name="slots",in="query",description="contacts",required=true,type="integer"),
     *   @SWG\Parameter(name="featured",in="query",description="contacts",required=true,type="integer"),
     *   @SWG\Parameter(name="booking_fee",in="query",description="booking fee",required=true,type="integer"),
     *   @SWG\Parameter(name="installments",in="query",description="installments",required=true,type="integer"),
     *   @SWG\Parameter(name="booking_fee_amount",in="query",description="booking_fee_amount",required=true,type="number"),
     *   @SWG\Parameter(name="instalment_amount",in="query",description="instalment_amount",required=true,type="number"),
     *   @SWG\Parameter(name="total_cost",in="query",description="total_cost",required=true,type="number"),
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

    /**
     * @SWG\Get(
     *   path="/activity/group/{group_id}",
     *   tags={"Activity"},
     *   summary="Activity by group",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="group_id",in="path",description="group id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function byGroup($group_id)
    {
        try{
            return GroupActivityResource::collection(GroupActivity::where('group_id', $group_id )->get());
        }catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ],500);
        }
    }
}
