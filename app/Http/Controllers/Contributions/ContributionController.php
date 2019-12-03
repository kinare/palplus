<?php

namespace App\Http\Controllers\Contributions;

use App\Contribution;
use App\ContributionCategory;
use App\ContributionType;
use App\Group;
use App\GroupSetting;
use App\GroupType;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\MembersController;
use App\Http\Resources\ContributionResource;
use App\Members;
use App\User;
use App\Wallet;
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

        //validate wallet
        $wallet = Wallet::where('user_id', $request->user()->id)->first();
        if (!$wallet->canWithdraw($request->amount))
            return response()->json([
                'message' => 'Insufficient funds. top up to continue'
            ], 401);


        $type = ContributionType::find($request->contribution_types_id);
        $member = Members::where([
            'user_id' => $request->user()->id,
            'group_id' => $type->group_id,
        ])->first();

        $contribution = Contribution::contribute($type, $member, $request->amount);
        return response()->json([
            'message' => 'Contribution Successful'
        ], 200);
    }



}
