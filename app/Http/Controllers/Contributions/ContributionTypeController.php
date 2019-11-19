<?php

namespace App\Http\Controllers\Contributions;

use App\Contribution;
use App\ContributionCategory;
use App\ContributionType;
use App\Group;
use App\GroupSetting;
use App\GroupType;
use App\Http\Controllers\BaseController;
use App\Http\Resources\ContributionTypeResource;
use Exception;

class ContributionTypeController extends BaseController
{
    public function __construct($model = ContributionType::class, $resource = ContributionTypeResource::class)
    {
        parent::__construct($model, $resource);
    }

    /**
     * @SWG\Get(
     *   path="/contribution/types",
     *   tags={"Contributions"},
     *   summary="Retrieve Contributions types",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */

    /**
     * @SWG\Get(
     *   path="/contribution/types/group/{group_id}",
     *   tags={"Contributions"},
     *   summary="Retrieve all group contributions Contributions",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="group_id",in="path",description="group id",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */

    public function byGroup($group_id)
    {
        try{
            return ContributionTypeResource::collection(ContributionType::where('group_id', $group_id)->get());
        }catch (Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * @SWG\Post(
     *   path="/contribution/types",
     *   tags={"Contributions"},
     *   summary="Create Contributions type",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="group_id",in="query",description="group_id",required=true,type="integer"),
     *   @SWG\Parameter(name="contribution_categories_id",in="query",description="contribution_categories_id",required=true,type="integer"),
     *   @SWG\Parameter(name="contribution_periods_id",in="query",description="contribution_periods_id",required=true,type="integer"),
     *   @SWG\Parameter(name="activity_id",in="query",description="activity id",required=false,type="integer"),
     *   @SWG\Parameter(name="name",in="query",description="name",required=true,type="string"),
     *   @SWG\Parameter(name="description",in="query",description="description",required=true,type="string"),
     *   @SWG\Parameter(name="target_amount",in="query",description="target amount",required=true,type="number"),
     *   @SWG\Parameter(name="amount",in="query",description="amount per set period",required=true,type="number"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */


    /**
     * @SWG\Patch(
     *   path="/contribution/types/{id}",
     *   tags={"Contributions"},
     *   summary="Update Contributions",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Contribution type id",required=true,type="string"),
     *   @SWG\Parameter(name="group_id",in="query",description="group_id",required=true,type="integer"),
     *   @SWG\Parameter(name="contribution_categories_id",in="query",description="contribution_categories_id",required=true,type="integer"),
     *   @SWG\Parameter(name="contribution_periods_id",in="query",description="contribution_periods_id",required=true,type="integer"),
     *   @SWG\Parameter(name="activity_id",in="query",description="activity id",required=false,type="integer"),
     *   @SWG\Parameter(name="name",in="query",description="name",required=true,type="string"),
     *   @SWG\Parameter(name="description",in="query",description="description",required=true,type="string"),
     *   @SWG\Parameter(name="target_amount",in="query",description="target amount",required=true,type="number"),
     *   @SWG\Parameter(name="amount",in="query",description="amount per set period",required=true,type="number"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Get(
     *   path="/contribution/types/{id}",
     *   tags={"Contributions"},
     *   summary="Retrieve Contributions type",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Contribution type id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/contribution/types/{id}",
     *   tags={"Contributions"},
     *   summary="Delete Contributions type",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Contribution type id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/contribution/types/{id}/force",
     *   tags={"Contributions"},
     *   summary="Force delete Contributions Type",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Contribution type id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    public static function init(Group $group){
        $settings = GroupSetting::where('group_id', $group->id)->first();
        switch (GroupType::find($group->type_id)->type){
            case 'Mary-go-round' :
                ContributionType::init([
                   'group_id' => $group->id,
                   'contribution_periods_id'  => $settings->contribution_periods_id,
                   'name'  => 'Savings',
                   'description'  => $group->name.' contributions',
                   'amount'  => $settings->contribution_amount,
                   'target_amount'  => $settings->contribution_target_amount
                ]);
                break;
            case 'Tours-and-travel' :
                //Todo Generate form event
                break;
            case 'Fundraising' :
                ContributionType::init([
                    'group_id' => $group->id,
                    'contribution_periods_id'  => $settings->contribution_periods_id,
                    'contribution_categories_id' => $settings->contribution_categories_id,
                    'name'  => ContributionCategory::find($settings->contribution_categories_id)->category,
                    'description'  => 'Fundraising for '.$group->name,
                    'amount'  => $settings->contribution_amount,
                    'target_amount'  => $settings->contribution_target_amount
                ]);
                break;
            case 'Saving-and-investments' :
                ContributionType::init([
                    'group_id' => $group->id,
                    'contribution_periods_id'  => $settings->contribution_periods_id,
                    'contribution_categories_id' => $settings->contribution_categories_id,
                    'name'  => 'Savings',
                    'description'  => 'Group Savings',
                ]);
                break;
        }
    }


}
