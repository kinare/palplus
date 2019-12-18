<?php

namespace App\Observers;

use App\Contribution;
use App\ContributionType;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountingController;
use App\Http\Controllers\Finance\Transaction;
use App\Loan;
use App\Wallet;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Str;

class ContributionObserver
{
    /**
     * Handle the contribution "created" event.
     *
     * @param Contribution $contribution
     * @return void
     * @throws Exception
     */
    public function created(Contribution $contribution)
    {
        $type = ContributionType::find($contribution->contribution_types_id);
        $transaction = new Transaction();
        $transaction->transact(
            Wallet::where('user_id', $contribution->created_by)->first(),
            Wallet::where('group_id', $contribution->group_id)->first(),
            $contribution->amount,
            $type->name,
            $type->description
        );
    }

    /**
     * Handle the contribution "updated" event.
     *
     * @param Contribution $contribution
     * @return void
     */
    public function updated(Contribution $contribution)
    {
        //
    }

    /**
     * Handle the contribution "deleted" event.
     *
     * @param Contribution $contribution
     * @return void
     */
    public function deleted(Contribution $contribution)
    {
        //
    }

    /**
     * Handle the contribution "restored" event.
     *
     * @param Contribution $contribution
     * @return void
     */
    public function restored(Contribution $contribution)
    {
        //
    }

    /**
     * Handle the contribution "force deleted" event.
     *
     * @param Contribution $contribution
     * @return void
     */
    public function forceDeleted(Contribution $contribution)
    {
        //
    }
}
