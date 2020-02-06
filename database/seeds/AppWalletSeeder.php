<?php

use Illuminate\Database\Seeder;

class AppWalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wallet = \App\Wallet::whereUserId(0)->whereGroupId(0)->updateOrCreate([
            'type' => 'User',
            'user_id' => 0,
            'group_id' => 0,
            'currency_id' => 149,
        ]);
        $wallet->save();
    }
}
