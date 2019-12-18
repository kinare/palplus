<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\BaseController;
use App\Http\Resources\NotificationTypesResource;
use App\NotificationTypes;
use Illuminate\Http\Request;

class NotificationTypesController extends BaseController
{
    public function __construct($model = NotificationTypes::class, $resource = NotificationTypesResource::class)
    {
        parent::__construct($model, $resource);
    }

    /**
     * @SWG\Get(
     *   path="/notification/types",
     *   tags={"Notification"},
     *  security={
     *     {"bearer": {}},
     *   },
     *   summary="Retrieve Notification Types",
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
}
