<?php

namespace App\Console\Commands;

use App\Jobs\OverdueContributionsJob;
use Illuminate\Console\Command;

class ContributionsJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:contributions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process contribution and reminders';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        OverdueContributionsJob::dispatchNow();
    }
}
