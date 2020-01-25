<?php

namespace App\Http\Controllers\Gateway;

use App\Http\Controllers\BaseController;
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
            $body = @file_get_contents("php://input");

            $signature = (isset($_SERVER['HTTP_VERIF_HASH']) ? $_SERVER['HTTP_VERIF_HASH'] : '');

            if(!$signature || $signature !== env('RAVE_SECRET_HASH') ){
                exit();
            }

            http_response_code(200);

            $model = new $this->model();
            $model->payload = $body;
            $model->save();

            $response = json_decode($body);
            if ($response->status == 'successful') {
               GatewayTransactionController::processTransaction($response->txRef);
            }

            exit();
    }

    /**
     * @SWG\Post(
     *   path="/gateway/rave/test",
     *   tags={"Gateway"},
     *   summary="Rave Webhook Test",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="txref",in="query",description="Trans Ref",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function test(Request $request){
        return GatewayTransactionController::processTransaction($request->txref);
    }

    /**
     * @SWG\Get(
     *   path="/gateway/rave/process",
     *   tags={"Gateway"},
     *   summary="Proccess all webhook request",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function process(){
        $trans = RaveHookDump::all();
        foreach ($trans as $tran){
            $response = json_decode($tran->payload);
            if ($response->status == 'successful') {
                GatewayTransactionController::processTransaction($response->txRef);
            }
        }
    }




}
