<?php

use Illuminate\Database\Seeder;

class ApproverTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\ApproverTypes::truncate();
        \App\ApproverTypes::insert([
            ['type' => 'LOAN', 'description' => 'Loan approvers'],
            ['type' => 'WITHDRAWAL', 'description' => 'Withdrawal approvers']
        ]);
    }
}
