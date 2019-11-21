<?php

namespace App\Observers;

use App\Http\Controllers\AccountingController;
use App\Loan;
use App\Members;
use App\Notification;
use App\NotificationTypes;
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

            if ($loan->status = 'approved'){
                Notification::make([
                    'user_id' => Members::find($loan->member_id)->user_id,
                    'subject' => 'Loan Approval',
                    'message' => 'Your loan of '.$loan->loan_amount.' has been approved',
                    'payload' => '',
                    'notification_types_id' => NotificationTypes::getTypeId('APPROVAL'),
                ]);

                //transact
                AccountingController::transact(
                    Wallet::where('group_id', $loan->group_id)->first(),
                    Wallet::where('user_id', Members::find($loan->member_id)->user_id)->first(),
                    $loan->loan_amount,
                    [
                        'model' => Loan::class,
                        'model_id' => $loan->id,
                        'description' => 'Loan application',
                        'account' => '',
                        'transaction_code' => Str::random(10).Carbon::now()->timestamp,
                    ]
                );
            }

            if ($loan->status === 'declined'){
                Notification::make([
                    'user_id' => Members::find($loan->member_id)->user_id,
                    'subject' => 'Loan Application',
                    'message' => 'Your loan of '.$loan->loan_amount.' has been declined',
                    'payload' => '',
                    'notification_types_id' => NotificationTypes::getTypeId('APPROVAL'),
                ]);
            }
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
