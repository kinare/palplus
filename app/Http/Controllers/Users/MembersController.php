<?php

namespace App\Http\Controllers;

use App\Contribution;
use App\Http\Resources\ContributionResource;
use App\Http\Resources\LoansResource;
use App\Http\Resources\MemberResource;
use App\Http\Resources\PaymentResource;
use App\Loan;
use App\Members;
use App\Payment;
use App\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembersController extends BaseController
{
    public function __construct()
    {
        parent::__construct(Members::class, MemberResource::class);
    }

    /**
     * @SWG\Get(
     *   path="/member",
     *   tags={"Member"},
     *   summary="Retrieve Members",
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
     *   path="/member",
     *   tags={"Member"},
     *   summary="Create Member",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="group_id",in="query",description="Group id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Patch(
     *   path="/member/{id}",
     *   tags={"Member"},
     *   summary="Update Member",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="name",in="query",description="Group Name",required=true,type="string"),
     *   @SWG\Parameter(name="description",in="query",description="Group Description",required=true,type="string"),
     *   @SWG\Parameter(name="access_level",in="query",description="access level",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Get(
     *   path="/member/{id}",
     *   tags={"Member"},
     *   summary="Retrieve Member",
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
     *   path="/member/{id}",
     *   tags={"Member"},
     *   summary="Delete Member",
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
     *   path="/member/{id}/force",
     *   tags={"Member"},
     *   summary="Force delete Member",
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
     *   path="/member/activate/{id}",
     *   tags={"Member"},
     *   summary="Activate Member",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="member id",required=true, type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function activate($id)
    {
        $member = Members::find($id);
		$member->activate();
		$user  = User::find($member->user_id);
		$user->activate = "active";
		$user->save();
        return new MemberResource($member);
    }

    /**
     * @SWG\Get(
     *   path="/member/deactivate/{id}",
     *   tags={"Member"},
     *   summary="Deavtivate Member",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="member id",required=true, type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function deactivate($id)
    {
		$member = Members::find($id);
		$user  = User::find($member->user_id);
		$user->activate = "suspended";
		$user->save();
        $member->deActivate();
        return new MemberResource($member);
    }

    /**
     * @SWG\Get(
     *   path="/member/loans/{id}",
     *   tags={"Member"},
     *   summary="Member loans",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="member id",required=true, type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function loans($id)
    {
        return LoansResource::collection(Loan::whereMemberId($id)->get());
    }

    /**
     * @SWG\Get(
     *   path="/member/contributions/{id}",
     *   tags={"Member"},
     *   summary="Member Contributions",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="member id",required=true, type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function contributions($id)
    {
        return ContributionResource::collection(Contribution::whereMemberId($id)->get());
    }

    /**
     * @SWG\Get(
     *   path="/member/pending-payments/{id}",
     *   tags={"Member"},
     *   summary="Member Pending payments",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="member id",required=true, type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function payments($id)
    {
        $member = Members::find($id);
        return PaymentResource::collection(Payment::status('pending')->whereUserId($member->user_id)->get());
    }



    /**
     * @SWG\Get(
     *   path="/member/remove/{member_id}",
     *   tags={"Member"},
     *   summary="Remove Member",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="member_id",in="query",description="member id",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function remove($member_id){
        $member = Members::find($member_id);

        /* Get amount */
        $loans = Loan::total($member);
        $contributions = Contribution::total($member);
        $withdrawals = Withdrawal::total($member);
        $pending = Payment::total($member);
        $amount = (($contributions -$withdrawals)  - ($loans['balance'] + $pending));

        if ($amount > 0)
            $withdrawals = Withdrawal::withdraw($member, $amount);

        if ($amount < 0 )
            return response()->json([
                'message' => 'Member has pending payment'
            ], 403);

        $member->delete();
        return response()->json([
            'message' => 'Successful. approval request sent'
        ], 200);
    }

    public static function member(array $data) : Members
    {
        $member = new Members();
        $member->group_id = $data['group_id'];
        $member->user_id = $data['user_id'];
        $member->created_by = Auth::user()->id;
        $member->save();
        return $member;
    }

    public static function isAdmin($group_id) : bool
    {
        return Members::where([
            'user_id' => Auth::user()->id,
            'group_id' => $group_id
        ])->first()->is_admin;


    }
}
