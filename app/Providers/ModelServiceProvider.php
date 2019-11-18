<?php

namespace App\Providers;

use App\Contribution;
use App\Group;
use App\GroupSetting;
use App\Observers\ContributionObserver;
use App\Observers\GroupObserver;
use App\Observers\GroupSettingObserver;
use App\Observers\UserObserver;
use App\User;
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
        Contribution::observe(ContributionObserver::class);
        Group::observe(GroupObserver::class);
        GroupSetting::observe(GroupSettingObserver::class);
    }
}
