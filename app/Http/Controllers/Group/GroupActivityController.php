<?php

namespace App\Http\Controllers\Group;

use App\ActivityContacts;
use App\ActivityMembers;
use App\AdvertSetup;
use App\Contribution;
use App\ContributionType;
use App\GroupActivity;
use App\GroupExpense;
use App\Http\Controllers\AccountingController;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Currency\Converter;
use App\Http\Controllers\Finance\Transaction;
use App\Http\Resources\ActivityContactResource;
use App\Http\Resources\ContributionResource;
use App\Http\Resources\ContributionTypeResource;
use App\Http\Resources\GroupActivityResource;
use App\Http\Resources\GroupExpenseResource;
use App\Http\Resources\ItineraryResource;
use App\Http\Resources\MemberResource;
use App\Http\Resources\SupplierResource;
use App\Itinerary;
use App\Members;
use App\Suppliers;
use App\Wallet;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravolt\Avatar\Facade as Avatar;

class GroupActivityController extends BaseController
{
    public function __construct($model = GroupActivity::class, $resource = GroupActivityResource::class)
    {
        parent::__construct($model, $resource);
    }
    /**
     * @SWG\Get(
     *   path="/activity",
     *   tags={"Activity"},
     *   summary="Retrieve Activity",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function index()
    {
        try{
            return $this->response($this->model::orderBy('cut_off_date', 'ASC')->get());
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }

    }

    /**
     * @SWG\Post(
     *   path="/activity",
     *   tags={"Activity"},
     *   summary="Create Activity",
     *   produces={"application/json"},
     *   consumes={"multipart/form-data"},
     *   security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="group_id",in="formData",description="Group id",required=true,type="string"),
     *   @SWG\Parameter(name="activity_type_id",in="formData",description="Activity type id",required=true,type="string"),
     *   @SWG\Parameter(name="name",in="formData",description="name",required=true,type="string"),
     *   @SWG\Parameter(name="description",in="formData",description="description",required=true,type="string"),
     *   @SWG\Parameter(name="avatar",in="formData",description="avatar",required=false,type="file"),
     *   @SWG\Parameter(name="start_date",in="formData",description="start date",required=true,type="string"),
     *   @SWG\Parameter(name="end_date",in="formData",description="end date",required=true,type="string"),
     *   @SWG\Parameter(name="cut_off_date",in="formData",description="cut off date",required=false,type="string"),
     *   @SWG\Parameter(name="contacts",in="formData",description="contacts",required=false,type="string"),
     *   @SWG\Parameter(name="slots",in="formData",description="slots",required=false,type="integer"),
     *   @SWG\Parameter(name="has_contributions",in="formData",description="has_contributions",required=false,type="integer"),
     *   @SWG\Parameter(name="featured",in="formData",description="featured",required=false,type="integer"),
     *   @SWG\Parameter(name="booking_fee",in="formData",description="booking fee",required=false,type="integer"),
     *   @SWG\Parameter(name="installments",in="formData",description="installments",required=false,type="integer"),
     *   @SWG\Parameter(name="no_of_installments",in="formData",description="no_of_installments",required=false,type="integer"),
     *   @SWG\Parameter(name="booking_fee_amount",in="formData",description="booking_fee_amount",required=false,type="number"),
     *   @SWG\Parameter(name="instalment_amount",in="formData",description="instalment_amount",required=false,type="number"),
     *   @SWG\Parameter(name="total_cost",in="formData",description="total_cost",required=false,type="number"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function store(Request $request)
    {
        try{
            $model = new $this->model();
            $data = $request->all();
            $model->fill($data);
            $model->created_by = $request->user()->id;
            $model->save();

            if ($request->hasFile('avatar')){
                $attachment = [];
                $attachment['file'] = $request->file('avatar');
                $attachment['filename'] = $request->file('avatar')->getClientOriginalName();

                if (Storage::disk('avatars')->exists("activities/" . $model->id . '/' . $attachment['filename']))
                    $attachment['filename'] = uniqid().'.'.$attachment['file']->getClientOriginalExtension();

                Storage::disk('avatars')->put("activities/".$model->id.'/'.$attachment['filename'], file_get_contents($attachment['file']));
                $model->avatar = $attachment['filename'];
            }else{
                $avatar = Avatar::create($model->name)->getImageObject()->encode('png');
                Storage::disk('avatars')->put("activities/".$model->id.'/avatar.png', (string) $avatar);
                $model->avatar =  'avatar.png';
            }

            $model->save();
            dd($request->user()->id());
            $member  = Members::where("user_id", $request->user()->id)->where('group_id', $request->id)->first();



            //make first creator first member
            $actMember = new ActivityMembers();
            $actMember->group_id = $model->group_id;
            $actMember->member_id = Members::member($model->group_id)->id;
            $actMember->activity_id = $model->id;
            $actMember->status = $model->booking_fee ? 'inactive' : 'active';
            $actMember->save();





            if ($request->featured){
                $wallet = Wallet::mine();
                $adSetup = AdvertSetup::whereType('EVENT')->first();
                $adRate = Converter::Convert($adSetup->currency, $wallet->walletCurrency(), $adSetup->rate)['amount'];

                if (!$wallet->canWithdraw($adRate)){
                    $model->featured = 0;
                    $model->save();
                    return response()->json([
                        'message' => 'Your event would not be featured due to insufficient funds'
                    ]);
                }

                $transaction = new Transaction();
                $transaction->transact(
                    $wallet,
                    Wallet::app(),
                    $adRate,
                    'Ad Payment',
                    'Event add payment'
                );
            }

            return $this->response($model);
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }

    }


    

    /**
     * @SWG\Get(
     *   path="/activity/featured-rate",
     *   tags={"Activity"},
     *   summary="Get featured Activity rate",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function featuredRate(){
        $adSetup = AdvertSetup::whereType('EVENT')->first();
        $adRate = Converter::Convert($adSetup->currency, Wallet::mine()->walletCurrency(), $adSetup->rate)['amount'];
        return response()->json([
            'message' => 'A fee of '.Wallet::mine()->walletCurrency().' '.$adRate.' applies for this featured event.'
        ], 200);
    }

    /**
     * @SWG\Patch(
     *   path="/activity/{id}",
     *   tags={"Activity"},
     *   summary="Update Activity",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Activity id",required=true,type="string"),
     *   @SWG\Parameter(name="name",in="formData",description="name",required=true,type="string"),
     *   @SWG\Parameter(name="description",in="formData",description="description",required=true,type="string"),
     *   @SWG\Parameter(name="avatar",in="formData",description="avatar",required=false,type="file"),
     *   @SWG\Parameter(name="start_date",in="formData",description="start date",required=true,type="string"),
     *   @SWG\Parameter(name="end_date",in="formData",description="end date",required=true,type="string"),
     *   @SWG\Parameter(name="cut_off_date",in="formData",description="cut off date",required=false,type="string"),
     *   @SWG\Parameter(name="contacts",in="formData",description="contacts",required=false,type="string"),
     *   @SWG\Parameter(name="slots",in="formData",description="slots",required=false,type="integer"),
     *   @SWG\Parameter(name="has_contributions",in="formData",description="has_contributions",required=false,type="integer"),
     *   @SWG\Parameter(name="featured",in="formData",description="featured",required=false,type="integer"),
     *   @SWG\Parameter(name="booking_fee",in="formData",description="booking fee",required=false,type="integer"),
     *   @SWG\Parameter(name="installments",in="formData",description="installments",required=false,type="integer"),
     *   @SWG\Parameter(name="no_of_installments",in="formData",description="no_of_installments",required=false,type="integer"),
     *   @SWG\Parameter(name="booking_fee_amount",in="formData",description="booking_fee_amount",required=false,type="number"),
     *   @SWG\Parameter(name="instalment_amount",in="formData",description="instalment_amount",required=false,type="number"),
     *   @SWG\Parameter(name="total_cost",in="formData",description="total_cost",required=false,type="number"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Get(
     *   path="/activity/{id}",
     *   tags={"Activity"},
     *   summary="Retrieve Activity",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="activity id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/activity/{id}",
     *   tags={"Activity"},
     *   summary="Delete Activity",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="activity id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/activity/{id}/force",
     *   tags={"Activity"},
     *   summary="Force delete Activity",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="activity id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Get(
     *   path="/activity/contribution-types/{activity_id}",
     *   tags={"Activity"},
     *   summary="Retrieve Activity contribution types",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="activity_id",in="path",description="activity id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function activityContributionTypes(Request $request, $activity_id){
        try{

            $member = Members::member( GroupActivity::find($activity_id)->group_id);
            $actMember = ActivityMembers::where([
                'activity_id' => $activity_id,
                'member_id' =>  $member->id
            ])->first();

             $types = ContributionType::where([
                'activity_id' => $activity_id,
                'booking_fee' => $actMember->status === 'active' ? false : true
                ]
            )->get();

            $type_ids = [];
            foreach ($types as $type){
                array_push($type_ids, $type->id);
            }

            $contributions = Contribution::whereIn('contribution_types_id', $type_ids)
                ->where('member_id', $member->id)->get();

            $type_ids = [];
            foreach ($contributions as $contribution){
                array_push($type_ids, $contribution->contribution_types_id);
            }
            return ContributionTypeResource::collection($types->whereNotIn('id', $type_ids));
        }catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ],500);
        }
    }

    /**
     * @SWG\Post(
     *   path="/activity/join",
     *   tags={"Activity"},
     *   summary="Join activity",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="member_id",in="query",description="member id",required=true,type="integer"),
     *   @SWG\Parameter(name="activity_id",in="query",description="activity id",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function join(Request $request){
        try{
            $request->validate([
                'member_id' => 'required',
                'activity_id' => 'required',
            ]);

            $activity = GroupActivity::find($request->activity_id);

            if ($activity->isMember($request->member_id))
                return response()->json([
                    'message' => 'You are already a member in this activity'
                ], 500);

            if (!$activity->canJoin())
                return response()->json([
                    'message' => 'Sorry, Joining period expired'
                ], 500);

            if (!$activity->hasSlots())
                return response()->json([
                    'message' => 'Sorry, no slot available'
                ], 500);

            $actMember = new ActivityMembers();
            $actMember->group_id = $activity->group_id;
            $actMember->member_id = Members::member($activity->group_id)->id;
            $actMember->activity_id = $activity->id;
            $actMember->status = $activity->booking_fee ? 'inactive' : 'active';
            $actMember->save();

            $activity->slots--;
            $activity->save();

            return response()->json([
                'message' => 'Succesfully joined '.$activity->name
            ], 200);
        }catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ],500);
        }


    }

    /**
     * @SWG\Post(
     *   path="/activity/leave",
     *   tags={"Activity"},
     *   summary="Leave activity",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="member_id",in="query",description="member id",required=true,type="integer"),
     *   @SWG\Parameter(name="activity_id",in="query",description="activity id",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function leave(Request $request){
        try{
            $request->validate([
                'member_id' => 'required',
                'activity_id' => 'required',
            ]);

            $activity = GroupActivity::find($request->activity_id);

            if (!$activity->isMember($request->member_id))
                return response()->json([
                    'message' => 'You are not a member in this activity'
                ], 500);

            $member = ActivityMembers::where('member_id', $request->member_id)->first();
            $member->forceDelete();

            return response()->json([
                'message' => 'You have successfully left '.$activity->name
            ], 200);

        }catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ],500);
        }
    }

    /**
     * @SWG\Post(
     *   path="/activity/pay",
     *   tags={"Activity"},
     *   summary="Pay for activity",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="contribution_type_id",in="query",description="contribution type id",required=true,type="integer"),
     *   @SWG\Parameter(name="amount",in="query",description="amount",required=true,type="number"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function pay(Request $request){
        try{
            $request->validate([
                'contribution_type_id' => 'required',
                'amount' => 'required',
            ]);

            /* Get type and validate amount */
            $type = ContributionType::find($request->contribution_type_id);
            if ($request->amount < $type->amount)
                return response()->json([
                    'message' => 'Failed, contribution amount should be '.$type->amount
                ], 401);

            /* Get wallet and validate amount */
            $myWallet = Wallet::mine();
            if (!$myWallet->canWithdraw($request->amount))
                return response()->json([
                    'message' => 'Insufficient Funds. top up to continue'
                ], 401);

            /* Get member and perform contribution */
            $member = Members::member($type->group_id);
            $contribution = Contribution::contribute($type, $member, $request->amount);

            /* activate member if contribution is booking fee */
            if ($contribution)
                if ($type->booking_fee){
                    $actMemb = ActivityMembers::where(['member_id' => $member->id, 'activity_id' => $type->activity_id])->first();
                    $actMemb->status = 'active';
                    $actMemb->save();
                }

            return response()->json([
                'message' => 'Contribution successful'
            ], 200);

        }catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ],500);
        }
    }

    /**
     * @SWG\Get(
     *   path="/activity/members/{activity_id}",
     *   tags={"Activity"},
     *   summary="Activity Members ",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="activity_id",in="path",description="activity id",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function members($activity_id){
        try{
            $actMembers = ActivityMembers::where('activity_id', $activity_id)->get();
            $members = [];
            foreach ($actMembers as $actMember){
                array_push($members, $actMember->member_id);
            }
            return MemberResource::collection(Members::whereIn('id', $members)->get());
        }catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ],500);
        }
    }

    /**
     * @SWG\Get(
     *   path="/activity/itineraries/{activity_id}",
     *   tags={"Activity"},
     *   summary="Activity Itineraries",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="activity_id",in="path",description="activity id",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function itinerary($activity_id){
        try{
            return ItineraryResource::collection(Itinerary::where('activity_id', $activity_id)->get());
        }catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ],500);
        }
    }

    /**
     * @SWG\Get(
     *   path="/activity/contacts/{activity_id}",
     *   tags={"Activity"},
     *   summary="Activity Emergency Contacts",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="activity_id",in="path",description="activity id",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function contact($activity_id){
        try{
            return ActivityContactResource::collection(ActivityContacts::where('activity_id', $activity_id)->get());
        }catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ],500);
        }
    }

    /**
     * @SWG\Get(
     *   path="/activity/suppliers/{activity_id}",
     *   tags={"Activity"},
     *   summary="Activity Suppliers",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="activity_id",in="path",description="activity id",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function supplier($activity_id){
        try{
            return SupplierResource::collection(Suppliers::where('activity_id', $activity_id)->get());
        }catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ],500);
        }
    }

    /**
     * @SWG\Get(
     *   path="/activity/expenses/{activity_id}",
     *   tags={"Activity"},
     *   summary="Activity Expenses",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="activity_id",in="path",description="activity id",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function expenses($activity_id){
        try{
            return GroupExpenseResource::collection(GroupExpense::where('activity_id', $activity_id)->get());
        }catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ],500);
        }
    }

    /**
     * @SWG\Get(
     *   path="/activity/featured",
     *   tags={"Activity"},
     *   summary="Featured activities",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function featured(){
        try{
            return GroupActivityResource::collection(GroupActivity::featured()->get());
        }catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ],500);
        }
    }

    /**
     * @SWG\Get(
     *   path="/activity/wallet/{activity_id}",
     *   tags={"Activity"},
     *   summary="Activity wallet",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="activity_id",in="path",description="activity id",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function wallet($activity_id){
        $types = ContributionType::whereActivityId($activity_id)->get();
        $ids = [];
        foreach ($types as $type) {
            array_push($ids, $type->id);
        }

        $contributions = Contribution::whereIn('contribution_types_id', $ids)->get();
        $activity = GroupActivity::find($activity_id);

        $total = 0.00;
        foreach ($contributions as $contribution){
            $total += (float)$contribution->amount;
        }

        return response()->json([
            'data' => [
                'target' => $activity->total_cost,
                'total_contribution' => (float)$total,
                'currency' => Wallet::whereGroupId($activity->group_id)->first()->walletCurrency()
            ]
        ], 200);
    }

    /**
     * @SWG\Get(
     *   path="/activity/contributions/{activity_id}",
     *   tags={"Activity"},
     *   summary="Activity contributions",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="activity_id",in="path",description="activity id",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function contributions($activity_id){
        $types = ContributionType::whereActivityId($activity_id)->get();
        $ids = [];
        foreach ($types as $type) {
            array_push($ids, $type->id);
        }
         $contributions = Contribution::whereIn('contribution_types_id', $ids)->get();
        return ContributionResource::collection($contributions);
    }

    /**
     * @SWG\Get(
     *   path="/activity/my-contributions/{activity_id}",
     *   tags={"Activity"},
     *   summary="Activity my contributions",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="activity_id",in="path",description="activity id",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function myContributions($activity_id){
        $type = ContributionType::whereActivityId($activity_id)->firstOrFail();
        $contributions = Contribution::where([
            'contribution_types_id' => $type->id,
            'member_id' => Members::member($type->group_id)->id
        ])->get();
        return ContributionResource::collection($contributions);
    }
}
