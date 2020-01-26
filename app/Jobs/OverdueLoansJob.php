<?php

namespace App\Jobs;

use App\Loan;
use App\LoanSetting;
use App\Members;
use App\Notification;
use App\NotificationTypes;
use App\Wallet;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OverdueLoansJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $loans = Loan::whereOverdue(false)->get();
        foreach ($loans as $loan){

            //mark overdue loans
            if ($loan->end_date > Carbon::now()){
                $loan->overdue = true;
                $loan->save();

                //send notification
                $member = Members::find($loan->member_id);
                Notification::make([
                    'user_id' => $member->user_id,
                    'subject' => 'Overdue Loan',
                    'message' => 'Your loan of '.Wallet::whereUserId($member->user_id)->currencyShortDesc.' '.$loan->loan_amount.' is overdue',
                    'payload' => $loan->code,
                    'notification_types_id' => NotificationTypes::getTypeId('LOAN'),
                ]);
            }

            if (Carbon::now()->diffInDays($loan->end_date, true)  <= 1 ){
                //send notification
                $member = Members::find($loan->member_id);
                Notification::make([
                    'user_id' => $member->user_id,
                    'subject' => 'Loan Reminder',
                    'message' => 'Your loan of '.Wallet::whereUserId($member->user_id)->currencyShortDesc.' '.$loan->loan_amount.' will be overdue on '.Carbon::parse($loan->end_date)->toFormattedDateString(),
                    'payload' => $loan->code,
                    'notification_types_id' => NotificationTypes::getTypeId('LOAN'),
                ]);
            }
            echo $loan->code.' processed';
        }
        echo'Run loans finished';
    }
}
