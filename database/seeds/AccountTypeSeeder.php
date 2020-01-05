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
            ['type' => 'MOBILE', 'description' => 'M-pesa account'],
            ['type' => 'ACCOUNT', 'description' => 'Bank account'],
            ['type' => 'CARD', 'description' => 'Credit/Debit card'],
            ['type' => 'PAYPAL', 'description' => 'Paypal account'],
        ]);
    }
}
