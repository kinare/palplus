<?php

namespace App\Http\Controllers;

use App\Http\Resources\RaveHookDumpResource;
use App\RaveHookDump;
use Illuminate\Http\Request;

class RaveHookDumpController extends BaseController
{
    public function __construct($model = RaveHookDump::class, $resource = RaveHookDumpResource::class)
    {
        parent::__construct($model, $resource);
    }

    /**
     * @SWG\Get(
     *   path="/gateway/rave",
     *   tags={"Gateway"},
     *   summary="Vie Hook requests ",
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
     *   path="/gateway/rave/hook",
     *   tags={"Gateway"},
     *   summary="Rave Webhook",
     *   @SWG\Parameter(name="payload",in="query",description="payload",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */

    public function store(Request $request)
    {
        try{
            $model = new $this->model();
            $model->payload = serialize($request->all());
            $model->save();
            return $this->response($model);
        }catch (\Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }


}
