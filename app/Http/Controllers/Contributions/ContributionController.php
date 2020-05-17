<?php

namespace App\Http\Controllers\Contributions;

use App\Contribution;
use App\Notification;
use App\ContributionType;
use App\NotificationTypes;
use App\Http\Controllers\BaseController;
use App\Http\Resources\ContributionResource;
use App\Http\Controllers\Notification\NotificationController;
use App\Members;
use App\Payment;
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
     * 'contribution_types_id','group_id','member_id','amount',
     */
    public function contribute(Request $request){

        $request->validate([
            'contribution_types_id' => 'required',
            'amount' => 'required',
        ]);

        $type = ContributionType::find($request->contribution_types_id);
        $member = Members::member($type->group_id);

        if ($type->amount && $request->amount < $type->amount)
            return response()->json([
                'message' => 'Failed, contribution amount should be '.$type->amount
            ], 401);


        //validate wallet
        $wallet = Wallet::mine();
        if (!$wallet->canWithdraw($request->amount))
            return response()->json([
                'message' => 'Insufficient funds. top up to continue'
            ], 401);

        $contribution = Contribution::contribute($type, $member, $request->amount);

        /*if contribution is membership fee activate member*/
        if ($contribution)
            if($type->membership_fee){
                $member->active = true;
                $member->save();

                /*clear pending payments*/
                $payment = Payment::whereUserId($request->user()->id)->whereModel(ContributionType::class)->whereModelId($type->id)->first();
                $payment->status = 'cleared';
                $payment->save();
			}
			/***Notifying the user */
			$notification_type = NotificationTypes::where('type', '')->first();
			Notification::create([
				'subject' => 'Contributions',
				'user_id' => $request->user()->id,
				'created_by' =>$request->user()->id,
				'notification_types_id' => $notification_type->id,
				'payload' => null,
				'message' => 'You have contributed  '. $wallet->currencyShortDesc() .' '. $request->amount . ' successfully.',
			]);
			// end of notifying user
        return response()->json([
            'message' => 'Contribution Successful'
        ], 200);
    }



}
