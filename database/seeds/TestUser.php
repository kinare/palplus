<?php

use App\User;
use App\Wallet;

use Illuminate\Database\Seeder;

class TestUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::insert([
            [
                'name' => 'Michael',
                'email' => 'mykmau93@gmail.com',
                'phone' => '+254708338855',
                'currency_id' => '74',
                'active' => true,
                'phone_verified' => true,
                'verification_code' => '',
                'password' => \Illuminate\Support\Facades\Hash::make('11111111'),
            ],
            [
                'name' => 'Alvin',
                'email' => 'otienoalvin44@gmail.com',
                'phone' => '+254799581989',
                'currency_id' => '254',
                'active' => true,
                'phone_verified' => true,
                'verification_code' => '',
                'password' => \Illuminate\Support\Facades\Hash::make('1234'),
            ]
        ]);


    }
}
