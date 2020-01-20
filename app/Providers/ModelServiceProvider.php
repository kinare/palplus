<?php

namespace App\Providers;

use App\ActivityMembers;
use App\Contribution;
use App\Group;
use App\GroupActivity;
use App\GroupProject;
use App\GroupSetting;
use App\Invitation;
use App\Loan;
use App\Members;
use App\Observers\ActivityMemberObserver;
use App\Observers\ActivityObserver;
use App\Observers\ContributionObserver;
use App\Observers\GroupObserver;
use App\Observers\GroupProjectObserver;
use App\Observers\GroupSettingObserver;
use App\Observers\InvitationObserver;
use App\Observers\LoanObserver;
use App\Observers\MemberObserver;
use App\Observers\PenaltyObserver;
use App\Observers\UserObserver;
use App\Observers\WithdrawalObserver;
use App\Penalty;
use App\User;
use App\Withdrawal;
use Illuminate\Support\ServiceProvider;

class ModelServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //Register Observers
        User::observe(UserObserver::class);
        Members::observe(MemberObserver::class);
        Contribution::observe(ContributionObserver::class);
        Group::observe(GroupObserver::class);
        GroupSetting::observe(GroupSettingObserver::class);
        GroupProject::observe(GroupProjectObserver::class);
        GroupActivity::observe(ActivityObserver::class);
        ActivityMembers::observe(ActivityMemberObserver::class);
        Loan::observe(LoanObserver::class);
        Withdrawal::observe(WithdrawalObserver::class);
        Penalty::observe(PenaltyObserver::class);
        Invitation::observe(InvitationObserver::class);
    }
}
