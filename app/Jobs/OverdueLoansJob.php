<?php

namespace App\Jobs;

use App\Loan;
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
            if ($loan->end_date > Carbon::now()){
                $loan->overdue = true;
                $loan->save();
                echo $loan->code.' overdue';
            }
        }
    }
}
