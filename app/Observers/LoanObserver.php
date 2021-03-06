<?php

namespace App\Observers;

use App\Contribution;
use App\Http\Controllers\AccountingController;
use App\Http\Controllers\Finance\Transaction;
use App\Loan;
use App\Members;
use App\Notification;
use App\NotificationTypes;
use App\Payment;
use App\User;
use App\Wallet;
use Carbon\Carbon;
use Illuminate\Support\Str;

class LoanObserver
{
    /**
     * Handle the loan "created" event.
     *
     * @param  \App\Loan  $loan
     * @return void
     */
    public function created(Loan $loan)
    {
        $applicant = User::find(Members::find($loan->member_id)->user_id);
        $approvers = Members::approvers($loan->group_id);
        foreach ($approvers as $approver){
            Notification::make([
                'user_id' => $approver->user_id,
                'subject' => 'Loan Request',
                'message' => $applicant->name.' loan application of '.$loan->loan_amount,
                'payload' => $loan->code,
                'notification_types_id' => NotificationTypes::getTypeId('LOAN'),
             ]);
        }
    }

    /**
     * Handle the loan "updated" event.
     *
     * @param \App\Loan $loan
     * @return void
     * @throws \Exception
     */
    public function updated(Loan $loan)
    {
        if ($loan->isDirty('status')){

            //Get Member
            $member = Members::find($loan->member_id);

            if ($loan->status = 'approved'){
                Notification::make([
                    'user_id' => $member->user_id,
                    'subject' => 'Loan Approval',
                    'message' => 'Your loan of '.$loan->loan_amount.' has been approved',
                    'payload' => '',
                    'notification_types_id' => NotificationTypes::getTypeId('APPROVAL'),
                ]);

                //transact
                $transaction = new Transaction();
                $transaction->transact(
                    Wallet::where('group_id', $loan->group_id)->first(),
                    Wallet::where('user_id', $member->user_id)->first(),
                    $loan->loan_amount,
                    'Loan',
                    'Loan Application'
                );
            }

            if ($loan->status === 'declined'){

                //Send notice
                Notification::make([
                    'user_id' =>$member->user_id,
                    'subject' => 'Loan Application',
                    'message' => 'Your loan of '.$loan->loan_amount.' has been declined',
                    'payload' => '',
                    'notification_types_id' => NotificationTypes::getTypeId('APPROVAL'),
                ]);
            }

            //create a pending payment for the loan
            Payment::init([
                'user_id' => $member->user_id,
                'group_id' => $member->group_id,
                'description' => 'Loan repayment',
                'model' => Loan::class,
                'model_id' => $loan->id,
                'transaction_code' => $loan->code,
                'amount' =>  $loan->loan_amount,
            ]);
        }
    }

    /**
     * Handle the loan "deleted" event.
     *
     * @param  \App\Loan  $loan
     * @return void
     */
    public function deleted(Loan $loan)
    {
        //
    }

    /**
     * Handle the loan "restored" event.
     *
     * @param  \App\Loan  $loan
     * @return void
     */
    public function restored(Loan $loan)
    {
        //
    }

    /**
     * Handle the loan "force deleted" event.
     *
     * @param  \App\Loan  $loan
     * @return void
     */
    public function forceDeleted(Loan $loan)
    {
        //
    }
}
