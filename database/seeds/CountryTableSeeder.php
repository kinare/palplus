<?php

use App\Country;
use Illuminate\Database\Seeder;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = file_get_contents(base_path('database/seeds/counties.json'));
        $data = json_decode($file, true);
        foreach($data as $county_data){
            $county  = County::create([
                'name' => $county_data["name"],
                'dial_code' => $county_data["dial_code"],
                'code' => $county_data["code"] ?  $county_data["code"]: ''
            ]);
        }
    }
}
