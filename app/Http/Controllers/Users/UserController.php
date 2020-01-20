<?php

namespace App\Http\Controllers\Users;

use App\Account;
use App\Contribution;
use App\Group;
use App\Http\Controllers\AccountingController;
use App\Http\Controllers\BaseController;
use App\Http\Resources\AccountResource;
use App\Http\Resources\ContributionResource;
use App\Http\Resources\GroupResource;
use App\Http\Resources\LoansResource;
use App\Http\Resources\NextOfKinResource;
use App\Http\Resources\NotificationResource;
use App\Http\Resources\PaymentResource;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\WalletResource;
use App\Loan;
use App\Members;
use App\Notification;
use App\Payment;
use App\Transaction;
use App\User;
use App\Wallet;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends BaseController
{
    public function __construct()
    {
        parent::__construct(User::class, UserResource::class);
    }

    /**
 * @SWG\Get(
 *   path="/user",
 *   tags={"User"},
 *   summary="All Users List",
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
     * @SWG\Get(
     *   path="/user/{id}",
     *   tags={"User"},
     *   summary="Retrieve User",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="User Id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Patch(
     *   path="/user/{id}",
     *   tags={"User"},
     *   summary="Update a user",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="name",in="path",description="name",required=true,type="string"),
     *   @SWG\Parameter(name="email",in="path",description="name",required=true,type="string"),
     *   @SWG\Parameter(name="country_code",in="path",description="name",required=true,type="string"),
     *   @SWG\Parameter(name="phone",in="path",description="name",required=true,type="string"),
     *   @SWG\Parameter(name="password",in="path",description="password",required=false,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/user/{id}",
     *   tags={"User"},
     *   summary="Soft delete a user",
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
     * @SWG\Delete(
     *   path="/user/{id}/force",
     *   tags={"User"},
     *   summary="Force delete a user",
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
     * @SWG\Get(
     *   path="/user/activate/{id}",
     *   tags={"User"},
     *   summary="Activate a user",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="User Id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function activate($id)
    {
        try{
            $user = $this->model::find($id);
            $user->active = true;
            $user->save();
            return $this->response($user);
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @SWG\Get(
     *   path="/user/deactivate/{id}",
     *   tags={"User"},
     *   summary="Dectivate a user",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="User Id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function deactivate($id)
    {
        try{
            $user = $this->model::find($id);
            $user->active = false;
            $user->save();
            return $this->response($user);
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @SWG\Get(
     *   path="/user/wallet",
     *   tags={"User"},
     *   summary="My wallet",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function wallet(Request $request)
    {
        try{
            return new WalletResource($request->user()->wallet()->first());
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @SWG\Get(
     *   path="/user/profile",
     *   tags={"User"},
     *   summary="My Profile",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function profile(Request $request)
    {
        try{
            return new ProfileResource($request->user()->profile()->get());

        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @SWG\Get(
     *   path="/user/nok",
     *   tags={"User"},
     *   summary="My Next of Kin",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function nok(Request $request)
    {
        try{
            return new NextOfKinResource($request->user()->nok()->get());

        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @SWG\Get(
     *   path="/user/groups",
     *   tags={"User"},
     *   summary="My Groups",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function groups(Request $request)
    {
        try{
            $memberships = Members::where('user_id', $request->user()->id)->get();
            $groupIds = [];
            foreach ($memberships as $membership){
                array_push($groupIds, $membership->group_id);
            }
            return GroupResource::collection(Group::find($groupIds));

        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @SWG\Get(
     *   path="/user/transactions",
     *   tags={"User"},
     *   summary="My Transactions",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function transactions(Request $request)
    {
        try{
           return TransactionResource::collection( Transaction::where('wallet_id', $request->user()->wallet()->first()->id)->get());
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @SWG\Get(
     *   path="/user/accounts",
     *   tags={"User"},
     *   summary="My Accounts",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function accounts(Request $request)
    {
        try{
            return new AccountResource($request->user()->accounts()->get());
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @SWG\Get(
     *   path="/user/payments",
     *   tags={"User"},
     *   summary="My Pending Payments",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function payments(Request $request)
    {
        try{
            return PaymentResource::collection(Payment::whereUserId($request->user()->id)->status('pending')->get());
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @SWG\Get(
     *   path="/user/loans",
     *   tags={"User"},
     *   summary="My Loan",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function loans(Request $request)
    {
        try{
            $memberships = Members::where('user_id', $request->user()->id)->get();
            $members = [];
            foreach ($memberships as $membership){
                array_push($members, $membership->id);
            }

            return LoansResource::collection(Loan::whereIn('member_id', $members)->get());
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @SWG\Get(
     *   path="/user/contributions",
     *   tags={"User"},
     *   summary="My Contributions",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function contributions(Request $request)
    {
        try{

            $groups = Members::where('user_id', $request->user()->id)->get();
            $memberships = [];
            foreach ($groups as $group){
                array_push($memberships, $group->id);
            }
            return  ContributionResource::collection(Contribution::whereIn('member_id', $memberships)->get());
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @SWG\Get(
     *   path="/user/contributions/group/{group_id}",
     *   tags={"User"},
     *   summary="My Group Contributions",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="group_id",in="path",description="group_id",required=false,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     * @param Request $request
     * @param $group_id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function contributionByGroup(Request $request, $group_id){
        try{
            $member = Members::where(['user_id' => $request->user()->id, 'group_id' => $group_id])->first();
            return ContributionResource::collection(Contribution::where('member_id', $member->id)->get());
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @SWG\Post(
     *   path="/user/deposit",
     *   tags={"User"},
     *   summary="Deposit to wallet",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="amount",in="query",description="amount",required=false,type="number"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     * @throws Exception
     */
    public function deposit(Request $request){

        $wallet = Wallet::where('user_id', $request->user()->id)->first();
        $account = Account::where('user_id', $request->user()->id)->first();
        $transaction = new \App\Http\Controllers\Finance\Transaction();

        $transaction->deposit($account, $wallet, $request->amount, 'Deposit', 'Wallet deposit');
        return response()->json([
            'message' => 'Deposit successful'
        ], 200);
    }

    /**
     * @SWG\Get(
     *   path="/user/notifications",
     *   tags={"User"},
     *   summary="My Notifications",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function notifications(Request $request){
        return NotificationResource::collection(Notification::where([
            'user_id' => $request->user()->id,
            'status' => 'active'
        ])->get());
    }


}
