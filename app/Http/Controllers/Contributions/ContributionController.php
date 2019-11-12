<?php

namespace App\Http\Controllers\Contributions;

use App\Contribution;
use App\ContributionType;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\MembersController;
use App\Http\Resources\ContributionResource;
use App\Members;
use App\User;
use Illuminate\Http\Request;

class ContributionController extends BaseController
{
    public function __construct($model = Contribution::class, $resource = ContributionResource::class)
    {
        parent::__construct($model, $resource);
    }

    /**
     * @SWG\Get(
     *   path="/contribution",
     *   tags={"Contributions"},
     *   summary="Retrieve all Contributions",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */

    /**
     * @SWG\Post(
     *   path="/contribution",
     *   tags={"Contributions"},
     *   summary="Contribute",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="contribution_types_id",in="query",description="contribution_types_id",required=true,type="integer"),
     *   @SWG\Parameter(name="amount",in="query",description="amount",required=true,type="number"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     * 'contribution_types_id',
    'group_id',
    'member_id',
    'amount',
     */
    public function contribute(Request $request){

        $request->validate([
            'contribution_types_id' => 'required',
            'amount' => 'required',
        ]);

        $type = ContributionType::find($request->contribution_types_id);
        $member = Members::where([
            'user_id' => $request->user()->id,
            'group_id' => $type->group_id,
        ])->first();

        $contribution = new Contribution();

        $contribution->contribution_types_id = $type->id;
        $contribution->group_id = $type->group_id;
        $contribution->member_id = $member->id;
        $contribution->amount = $request->amount;
        $contribution->created_by = $request->user()->id;
        $contribution->save();
        return $this->response($contribution);
    }


}