<?php

namespace App\Http\Controllers\Group;

use App\Http\Controllers\BaseController;
use App\Http\Resources\ItineraryResource;
use App\Itinerary;

class ItineraryController extends BaseController
{
    public function __construct($model = Itinerary::class, $resource = ItineraryResource::class)
    {
        parent::__construct($model, $resource);
    }

    /**
     * @SWG\Get(
     *   path="/activity/itinerary",
     *   tags={"Activity Itinerary"},
     *  security={
     *     {"bearer": {}},
     *   },
     *   summary="Retrieve Activity Itinerary",
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Post(
     *   path="/activity/itinerary",
     *   tags={"Activity Itinerary"},
     *   summary="Create Activity Itinerary",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="activity_id",in="query",description="activity_id",required=true,type="integer"),
     *   @SWG\Parameter(name="description",in="query",description="description",required=true,type="string"),
     *   @SWG\Parameter(name="location",in="query",description="location",required=true,type="string"),
     *   @SWG\Parameter(name="date",in="query",description="date",required=true,type="string"),
     *   @SWG\Parameter(name="time",in="query",description="time",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */

    /**
     * @SWG\Patch(
     *   path="/activity/itinerary/{id}",
     *   tags={"Activity Itinerary"},
     *   summary="Update Activity Itinerary",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Activity Itinerary id",required=true,type="string"),
     *   @SWG\Parameter(name="description",in="query",description="description",required=true,type="string"),
     *   @SWG\Parameter(name="location",in="query",description="location",required=true,type="string"),
     *   @SWG\Parameter(name="date",in="query",description="date",required=true,type="string"),
     *   @SWG\Parameter(name="time",in="query",description="time",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Get(
     *   path="/activity/itinerary/{id}",
     *   tags={"Activity Itinerary"},
     *   summary="Retrieve Activity Itinerary",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Activity Itinerary  id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/activity/itinerary/{id}",
     *   tags={"Activity Itinerary"},
     *   summary="Delete Activity Itinerary",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Activity Itinerary  id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/activity/itinerary/{id}/force",
     *   tags={"Activity Itinerary"},
     *   summary="Force delete Activity Itinerary",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Activity Itinerary  id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
}
