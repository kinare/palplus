<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\BaseController;
use App\Http\Resources\WithdrawalSettingResource;
use App\WithdrawalSetting;
use Illuminate\Http\Request;

class WithdrawalSettingController extends BaseController
{
    public function __construct($model = WithdrawalSetting::class, $resource = WithdrawalSettingResource::class)
    {
        parent::__construct($model, $resource);
    }

    /**
     * @SWG\Get(
     *   path="/withdrawal/settings",
     *   tags={"Withdrawal Settings"},
     *   summary="Retrieve Withdrawal Settings",
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
     *   path="/withdrawal/settings",
     *   tags={"Withdrawal Settings"},
     *   summary="Create Withdrawal Settings",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="group_id",in="query",description="group_id",required=true,type="integer"),
     *   @SWG\Parameter(name="qualification_period",in="query",description="qualification_period",required=true,type="number"),
     *   @SWG\Parameter(name="show_withdrawal",in="query",description="show_withdrawal",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */

    public function store(Request $request)
    {
        try{
            $setting = WithdrawalSetting::where('group_id', $request->group_id)->first();
            $model = $setting ? $setting : new $this->model();
            $data = $request->all();
            $model->fill($data);
            $model->created_by = $request->user()->id;
            $model->save();
            return $this->response($model);
        }catch (\Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }


    /**
     * @SWG\Patch(
     *   path="/withdrawal/settings/{id}",
     *   tags={"Withdrawal Settings"},
     *   summary="Update Withdrawal Settings",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Withdrawal Settings id",required=true,type="string"),
     *   @SWG\Parameter(name="group_id",in="query",description="group_id",required=true,type="integer"),
     *   @SWG\Parameter(name="qualification_period",in="query",description="qualification_period",required=true,type="number"),
     *   @SWG\Parameter(name="show_withdrawal",in="query",description="show_withdrawal",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Get(
     *   path="/withdrawal/settings/{id}",
     *   tags={"Withdrawal Settings"},
     *   summary="Retrieve a Withdrawal Settings",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Withdrawal Settings id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/withdrawal/settings/{id}",
     *   tags={"Withdrawal Settings"},
     *   summary="Delete Withdrawal Settings",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Withdrawal Settings id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Delete(
     *   path="withdrawal/settings/{id}/force",
     *   tags={"Withdrawal Settings"},
     *   summary="Force delete Withdrawal Settings",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Withdrawal Settings id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

}
