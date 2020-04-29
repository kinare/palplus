<?php

namespace App\Http\Controllers\Dashboard;

use App\ActivityMembers;
use App\GatewaySetup;
use App\Group;
use App\GroupActivity;
use App\GroupProject;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AdvertSetupController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Currency\CurrencyController;
use App\Http\Controllers\Finance\PaymentController;
use App\Http\Controllers\Finance\TransactionController;
use App\Http\Controllers\Finance\WithdrawalController;
use App\Http\Controllers\Gateway\GatewaySetupController;
use App\Http\Controllers\Group\GroupActivityController;
use App\Http\Controllers\Group\GroupController;
use App\Http\Controllers\Group\GroupProjectController;
use App\Http\Controllers\Group\GroupSettingController;
use App\Http\Controllers\Group\ReportingController;
use App\Http\Controllers\GroupSetupController;
use App\Http\Controllers\Investment\InvestmentOpportunityController;
use App\Http\Controllers\Loan\LoanController;
use App\Http\Controllers\Loan\LoanSettingController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\PaypalWithdrawalRequestController;
use App\Http\Controllers\Users\NextOfKinController;
use App\Http\Controllers\Users\UserController;
use App\Http\Resources\DahsboardTransactionsResource;
use App\Http\Resources\DashboardActivityResource;
use App\Http\Resources\GroupActivityResource;
use App\Http\Resources\GroupResource;
use App\Loan;
use App\Members;
use App\PaypalWithdrawalRequest;
use App\Transaction;
use App\User;
use App\Wallet;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * @SWG\Get(
     *   path="/dashboard",
     *   tags={"Dashboard"},
     *   summary="Get dashboard stats",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    public function index(){
        //get stats
        return [
            'data' => [
                'groups' => count(Group::all()),
                'wallets' => Wallet::total(),
                'users' => count(User::all()),
                'loans' => Loan::total()['amount']
            ]
        ];
    }

    /**
     * @SWG\Get(
     *   path="/dashboard/currency",
     *   tags={"Dashboard"},
     *   summary="Get currency",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function currency(){
        $currency = new CurrencyController();
        return $currency->index();
    }

    /**
     * @SWG\Get(
     *   path="/dashboard/wallet",
     *   tags={"Dashboard"},
     *   summary="Get wallets",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function wallets(){
        $wallet = new \App\Http\Controllers\Finance\WalletController();
        return $wallet->index();
    }

    /**
     * @SWG\Get(
     *   path="/dashboard/wallet/transactions",
     *   tags={"Dashboard"},
     *   summary="Get wallet transactions",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function walletTransactions(){
        $transactions = new TransactionController();
        return $transactions->index();
    }

    /**
     * @SWG\Get(
     *   path="/dashboard/admins",
     *   tags={"Dashboard"},
     *   summary="Get admins",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function admins(){
        $admins = new AdminController();
        return $admins->index();
    }

    /**
     * @SWG\Get(
     *   path="/dashboard/groups",
     *   tags={"Dashboard"},
     *   summary="Get groups",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function groups(){
        $groups= new GroupController();
        return $groups->index();
    }

    /**
     * @SWG\Get(
     *   path="/dashboard/group/{id}",
     *   tags={"Dashboard"},
     *   summary="Get group",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function group($id){
        $groups= new GroupController();
        return $groups->show($id);
    }

    /**
     * @SWG\Get(
     *   path="/dashboard/members",
     *   tags={"Dashboard"},
     *   summary="Get members",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function users(){
        $user = new UserController();

        return response()->json(['name' => 'Abigail', 'state' => 'CA']);
    }

    public function user($id){
        $user= new UserController();
        return $user->show($id);
    }

    public function membershipSettings(){
        $setting = new GroupSettingController();
        return $setting->index();
    }

    /**
     * @SWG\Get(
     *   path="/dashboard/transactions",
     *   tags={"Dashboard"},
     *   summary="Get transactions",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function transactions(){
        $transactions= new TransactionController(Transaction::class, DahsboardTransactionsResource::class);
        return $transactions->index();
    }

    /**
     * @SWG\Get(
     *   path="/dashboard/investments",
     *   tags={"Dashboard"},
     *   summary="Get investments",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function investments(){
        $investments = new InvestmentOpportunityController();
        return $investments->index();
    }

    /**
     * @SWG\Get(
     *   path="/dashboard/loans",
     *   tags={"Dashboard"},
     *   summary="Get loans",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function loans(){
        $loans = new LoanController();
        return $loans->index();
    }

    public function loanSettings(){
        $settings = new LoanSettingController();
        return $settings->index();
    }

    /**
     * @SWG\Get(
     *   path="/dashboard/withdrawal-requests",
     *   tags={"Dashboard"},
     *   summary="Get withdrawal-requests",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function withdrawalRequests(){
        $w = new WithdrawalController();
        return $w->index();
    }

    public function payments(){
        $payment = new PaymentController();
        return $payment->index();
    }

    public function activity(){
        $activity = new GroupActivityController(GroupActivity::class, DashboardActivityResource::class);
        return $activity->index();
    }

    public function memberActivity($id){
        $memberships = ActivityMembers::whereMemberId($id)->first();
        $ids = [];

        if ($memberships)
        foreach ($memberships as $membership){
            array_push($ids, $membership->activity_id);
        }
        return GroupActivityResource::collection(GroupActivity::whereIn('id', $ids)->get());
    }

    public function projects(){
        $project= new GroupProjectController();
        return $project->index();
    }

    public function myGroups($id){
        $memberships = Members::where('user_id', $id)->get();
        $groupIds = [];
        foreach ($memberships as $membership){
            array_push($groupIds, $membership->group_id);
        }
        return GroupResource::collection(Group::find($groupIds));
    }

    public function nok(){
        $nok = new NextOfKinController();
        return $nok->index();
    }

    public function setups(){
        $s = new GatewaySetupController();
        return $s->index();
    }

    public function setupsStore(Request $request){
        $r = new GatewaySetupController();
        return  $request->id ? $r->update($request, $request->id) : $r->store($request);
    }

    public function setup($id){
        $s = new GatewaySetupController();
        return $s->show($id);
    }

    public function paypalRequests(){
        $s = new PaypalWithdrawalRequestController();
        return $s->index();
    }

    public function suspendGroup(Request $request){
        $group = Group::find($request->id);
        $group->status = 'suspended';
        $group->active = false;
        $group->reasons = $request->reason;
        $group->save();
        return response()->json([
            'message' => 'group suspended'
        ],200);
    }

    public function suspendMember(Request $request){
        $user = User::find($request->id);
        $user->status = 'suspended';
        $user->active = false;
        $user->reasons = $request->reason;
        $user->save();
        return response()->json([
            'message' => 'User suspended'
        ],200);
    }

    public function toggleGroupActive(Request $request){
        $group = Group::find($request->id);
        $group->active = $group->active ? 0 : 1;
        $group->reasons = $request->reason;
        $group->status = $group->active ? 'inactive' : 'active' ;
        $group->save();
        return response()->json([
            'message' => 'group suspended'
        ],200);
    }

    public function toggleMemberActive(Request $request){
        $user = User::find($request->id);
        $user->active = $user->active ? 0 : 1;
        $user->reasons = $request->reason;
        $user->save();
        return response()->json([
            'message' => 'User'. $user->active ? "Acivated" : "Deactivated"
        ],200);
    }

    public function reportings(){
        $r = new ReportingController();
        return $r->index();
    }

    public function advertSetups(){
        $a = new AdvertSetupController();
        return $a->index();
    }

    public function advertSetup($id){
        $a = new AdvertSetupController();
        return $a->show($id);
    }

    public function saveAdvertSetup(Request $request){
        $a = new AdvertSetupController();
        return  $request->id ? $a->update($request, $request->id) : $a->store($request);
    }

    public function groupSetups(){
        $a = new GroupSetupController();
        return $a->index();
    }

    public function groupSetup($id){
        $a = new GroupSetupController();
        return $a->show($id);
    }

    public function saveGroupSetup(Request $request){
        $a = new GroupSetupController();
        return  $request->id ? $a->update($request, $request->id) : $a->store($request);
    }
}
