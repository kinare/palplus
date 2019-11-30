<?php

namespace App\Http\Controllers\Group;

use App\ActivityContacts;
use App\Http\Controllers\BaseController;
use App\Http\Resources\ActivityContactResource;

class ActivityContactsController extends BaseController
{
    public function __construct($model = ActivityContacts::class, $resource = ActivityContactResource::class)
    {
        parent::__construct($model, $resource);
    }

    /**
     * @SWG\Get(
     *   path="/activity/contact",
     *   tags={"Activity contact"},
     *  security={
     *     {"bearer": {}},
     *   },
     *   summary="Retrieve Activity contact",
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Post(
     *   path="/activity/contact",
     *   tags={"Activity contact"},
     *   summary="Create Activity contact",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="activity_id",in="query",description="activity id",required=true,type="integer"),
     *   @SWG\Parameter(name="name",in="query",description="name",required=true,type="string"),
     *   @SWG\Parameter(name="email",in="query",description="email",required=true,type="string"),
     *   @SWG\Parameter(name="location",in="query",description="location",required=true,type="string"),
     *   @SWG\Parameter(name="phone",in="query",description="phone",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */

    /**
     * @SWG\Patch(
     *   path="/activity/contact/{id}",
     *   tags={"Activity contact"},
     *   summary="Update Activity contact",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Activity contact id",required=true,type="integer"),
     *   @SWG\Parameter(name="name",in="query",description="name",required=true,type="string"),
     *   @SWG\Parameter(name="email",in="query",description="email",required=true,type="string"),
     *   @SWG\Parameter(name="location",in="query",description="location",required=true,type="string"),
     *   @SWG\Parameter(name="phone",in="query",description="phone",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Get(
     *   path="/activity/contact/{id}",
     *   tags={"Activity contact"},
     *   summary="Retrieve Activity contact",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Activity contact id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/activity/contact/{id}",
     *   tags={"Activity contact"},
     *   summary="Delete Activity contact",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Activity contact id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/activity/contact/{id}/force",
     *   tags={"Activity contact"},
     *   summary="Force delete Activity contact",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Activity contact id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

}
