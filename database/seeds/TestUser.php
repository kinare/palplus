<?php

use App\User;
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
            'name' => 'Michael',
            'email' => 'mykmau93@gmail.com',
            'phone' => '+254708338855',
            'country_code' => '254',
            'active' => true,
            'phone_verified' => true,
            'verification_code' => '',
            'password' => \Illuminate\Support\Facades\Hash::make('test@palplus.19'),
        ],
            [
                'name' => 'Alvin',
                'email' => 'otienoalvin44@gmail.com',
                'phone' => '+254799581989',
                'country_code' => '254',
                'active' => true,
                'phone_verified' => true,
                'verification_code' => '',
                'password' => \Illuminate\Support\Facades\Hash::make('1234'),
            ]);


    }
}
