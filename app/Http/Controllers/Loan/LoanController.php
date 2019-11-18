<?php

namespace App\Http\Controllers\Loan;

use App\Contribution;
use App\Group;
use App\Http\Controllers\BaseController;
use App\Http\Resources\LoansResource;
use App\Loan;
use App\LoanApprovalEntry;
use App\Members;
use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoanController extends BaseController
{
    public function __construct($model = Loan::class, $resource = LoansResource::class)
    {
        parent::__construct($model, $resource);
    }

    /**
     * @SWG\Get(
     *   path="/loan",
     *   tags={"Loan"},
     *  security={
     *     {"bearer": {}},
     *   },
     *   summary="Retrieve Loans",
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */

    /**
     * @SWG\Get(
     *   path="/loan/limit/{group_id}",
     *   tags={"Loan"},
     *   summary="Loan Limit",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="group_id",in="path",description="group_id",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */

    public function limit($group_id){
        return  [
            'data' => Loan::limit(Members::member($group_id))
        ];
    }

    /**
     * @SWG\Post(
     *   path="/loan",
     *   tags={"Loan"},
     *   summary="Create Loan Periods",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="group_id",in="query",description="group_id",required=true,type="integer"),
     *   @SWG\Parameter(name="loan_amount",in="query",description="loan_amount",required=true,type="number"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function loan(Request $request)
    {
        $request->validate([
            'group_id' => 'required',
            'loan_amount' => 'required',
            ]);

        //get member
        $member = Members::member($request->group_id);
        $group = Group::find($request->group_id);

        if (Loan::hasLoan($member))
            return response()->json([
                'message' => 'You have an active loan, clear the loan to apply again'
            ], 500);


        if (!Loan::isQualified($member))
            return response()->json([
                'message' => 'You dont qualify to apply for this loan'
            ], 500);

        if (!Contribution::hasContributions($member))
            return response()->json([
                'message' => 'You dont qualify to apply for this loan. Contribute/save more to increase loan limit'
            ], 500);

        if (!Group::hasFunds($group))
            return response()->json([
                'message' => 'Insufficient group funds'
            ], 500);

        if ($request->loan_amount > $this->limit($member->group_id)['data']['limit'])
            return response()->json([
                'message' => 'Your loan amount is over your limit'
            ], 500);


        $data = Loan::calculate($member);
        $loan = new Loan();
        $loan->code = Str::random(60);
        $loan->member_id = $member->id;
        $loan->group_id = $group->id;
        $loan->payment_period_id = $data['period'];
        $loan->loan_amount = $request->loan_amount;
        $loan->balance_amount = $request->loan_amount;
        $loan->start_date =$data['start'];
        $loan->end_date =$data['end'];
        $loan->save();

        /*
         * validations
         * check if has previous loan ->ok
         * check if has valid qualification period  ->ok
         * check if has savings and above set limit ->ok
         * check if group wallet has enough funds ->ok
         *
         * if ok!
         *
         * calculate loan amount and payment period
         *  - using group loan settings ->ok
         *
         *
         * save loan
         *  - create loan for user (one entry) ->ok
         *  - check no of approvers and attach to loan ->ok
         *  - send notice to validators
         *
         * return response loan is awaiting approval
         *
         *
         * */
        return response()->json([
            'message' => 'Your loan application has been successfully submitted for approval'
        ], 500);

    }

    /**
     * @SWG\Post(
     *   path="/loan/approve",
     *   tags={"Loan"},
     *   summary="Approve Member Loan",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="code",in="query",description="code",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function approve(Request $request)
    {

        $loan = Loan::whereCode($request->code)->first();

        $approver = Members::member($loan->group_id);

        if (!$approver->loan_approver)
            return response()->json([
                'message' => 'Unauthorized action. you are not an approver'
            ], 500);

        if (LoanApprovalEntry::hasApproved($loan))
            return response()->json([
                'message' => 'You have already approved'
            ], 500);

        if (count(LoanApprovalEntry::entries($loan)) === count(Members::approvers($loan->group_id)))

        LoanApprovalEntry::make($loan);
        $loan->status = 'approve';



        /*
         * Validate loan approver
         * check if loan is declined and reject request
         * find member loan and increase approvers count
         * change status to processing if not last approver
         * notify user if need be for the approval
         * if last approver save loan with approved status
         * transact amounts from group wallet to member wallet (observer)
         * notify member of approved loan and wallet balance (observer)
         * */
    }

    public function reject(Request $request)
    {
        /*
         * Validate loan approver
         * find member loan and reject loan request
         * change status to declined
         * notify user if need be for the decline
         * */
    }

    public function pay(Request $request)
    {
        /*
         * validate payment request
         * validate loan status and balance
         * validate wallet balance
         * transact from member account to group account
         * */
    }

}
