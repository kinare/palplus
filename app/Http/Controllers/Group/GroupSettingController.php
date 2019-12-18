<?php

namespace App\Http\Controllers\Group;

use App\Group;
use App\GroupSetting;
use App\GroupType;
use App\Http\Controllers\BaseController;
use App\Http\Resources\GroupSettingResource;
use Illuminate\Http\Request;

class GroupSettingController extends BaseController
{
    public function __construct($model = GroupSetting::class, $resource = GroupSettingResource::class)
    {
        parent::__construct($model, $resource);
    }

    /**
     * @SWG\Get(
     *   path="/group-setting",
     *   tags={"Group Setting"},
     *   summary="Retrieve Group Membership Settings",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    public static function init(Request $request, $group_id){
        $setting = new GroupSetting();
        $setting->fill($request->all());
        $setting->group_id = $group_id;
        $setting->created_by = $request->user()->id;
        $setting->save();
    }

    /**
     * @SWG\Post(
     *   path="/group-setting/{id}",
     *   tags={"Group Setting"},
     *   summary="Update group Membership Setting",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="group setting id",required=true,type="string"),
     *   @SWG\Parameter(name="membership_fee",in="query",description="has membership fee",required=true,type="integer"),
     *   @SWG\Parameter(name="membership_fee_amount",in="query",description="membership fee amount",required=false,type="number"),
     *   @SWG\Parameter(name="contributions",in="formData",description="has contributions",required=false,type="integer"),
     *   @SWG\Parameter(name="contribution_periods_id",in="query",description="contribution_period_id",required=false,type="integer"),
     *   @SWG\Parameter(name="contribution_amount",in="query",description="contribution_amount",required=false,type="number"),
     *   @SWG\Parameter(name="send_reminders",in="query",description="send_reminders",required=false,type="integer"),
     *   @SWG\Parameter(name="fixed_late_penalty",in="query",description="fixed_late_penalty",required=false,type="integer"),
     *   @SWG\Parameter(name="late_penalty_rate",in="query",description="late_penalty_rate",required=false,type="number"),
     *   @SWG\Parameter(name="late_penalty_amount",in="query",description="late_penalty_amount",required=false,type="number"),
     *   @SWG\Parameter(name="leaving_group_fee",in="query",description="leaving_group_fee",required=false,type="number"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */



    /**
     * @SWG\Get(
     *   path="/group-setting/{id}",
     *   tags={"Group Setting"},
     *   summary="Retrieve Group Membership Setting",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="group setting id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */



}
