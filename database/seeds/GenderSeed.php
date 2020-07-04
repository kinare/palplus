<?php

use Illuminate\Database\Seeder;
use App\Country;
use App\Currency;

class GenderSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Gender::truncate();
        \App\Gender::insert([
            ['gender' => 'male', 'created_at' => now()],
            ['gender' => 'female', 'created_at' => now()],
            ['gender' => 'other', 'created_at' => now()],
		]);
		

        Country::truncate();
        Currency::truncate();
		$file = file_get_contents(base_path('database/seeds/countries.json'));
        $data = json_decode($file, true);
        foreach($data as $key => $country_data){
            $county  = Country::create([
				'name' => ucfirst($country_data["CLDR display name"]) ? ucfirst($country_data["CLDR display name"]) : '' ,
				'currency_name' =>$country_data['ISO4217-currency_name'] ? $country_data['ISO4217-currency_name'] : '', 
				'currency_code' =>$country_data['ISO4217-currency_alphabetic_code'] ? $country_data['ISO4217-currency_alphabetic_code'] : '', 
                'dial_code' => $country_data["Dial"] ? '+'.$country_data["Dial"]: "",
                'code' => $country_data["ISO3166-1-Alpha-2"] ?  $country_data["ISO3166-1-Alpha-2"]: ''
            ]);

            // currency Table
            $county  = Currency::create([
                'country' => ucfirst($country_data["CLDR display name"]) ? ucfirst($country_data["CLDR display name"]) : '' ,
                'currency' =>$country_data['ISO4217-currency_name'] ? $country_data['ISO4217-currency_name'] : '', 
                'short_description' =>$country_data['ISO4217-currency_alphabetic_code'] ? $country_data['ISO4217-currency_alphabetic_code'] : '', 
                'dial_code' => $country_data["Dial"] ? '+'.$country_data["Dial"]: "",
                'country_code' => $country_data["ISO3166-1-Alpha-2"] ?  $country_data["ISO3166-1-Alpha-2"]: '',
                'rate' => 0
            ]);
        }
    }
}
