<?php

namespace App\Observers;

use App\Contribution;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountingController;
use App\Wallet;
use Exception;

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
        $from = Wallet::where('user_id', $contribution->created_by)->first();
        $to = Wallet::where('group_id', $contribution->group_id)->first();
        AccountingController::transact($from, $to, $contribution->amount);
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
