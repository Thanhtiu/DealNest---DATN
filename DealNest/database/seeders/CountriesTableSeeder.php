<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;

class CountriesTableSeeder extends Seeder
{
    public function run()
    {
        $countries = [
            ['name' => 'Vietnam', 'slug' => 'vietnam', 'status' => 1],
            ['name' => 'United States', 'slug' => 'united-states', 'status' => 1],
            ['name' => 'Japan', 'slug' => 'japan', 'status' => 1],
            ['name' => 'South Korea', 'slug' => 'south-korea', 'status' => 1],
            ['name' => 'China', 'slug' => 'china', 'status' => 1],
            ['name' => 'Germany', 'slug' => 'germany', 'status' => 1],
            ['name' => 'France', 'slug' => 'france', 'status' => 1],
            ['name' => 'United Kingdom', 'slug' => 'united-kingdom', 'status' => 1],
            ['name' => 'Canada', 'slug' => 'canada', 'status' => 1],
            ['name' => 'Australia', 'slug' => 'australia', 'status' => 1],
        ];

        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
