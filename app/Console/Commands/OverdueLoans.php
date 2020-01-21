<?php

namespace App\Console\Commands;

use App\Loan;
use Illuminate\Console\Command;

class OverdueLoans extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:loans';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process overdue loans';

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
        Loan::processOverdueLoans();
    }
}
