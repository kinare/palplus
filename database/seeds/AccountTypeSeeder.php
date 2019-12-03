<?php

use Illuminate\Database\Seeder;

class AccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\AccountType::truncate();
        \App\AccountType::insert([
            ['type' => 'MPESA', 'description' => 'M-pesa account'],
            ['type' => 'BANK', 'description' => 'Bank account'],
            ['type' => 'CARD', 'description' => 'Credit/Debit card'],
        ]);
    }
}
