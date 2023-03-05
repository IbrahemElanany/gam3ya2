<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $city = new City;
        $city->name = ['en' => 'Riyadh', 'ar' => 'الرياض'];
        $city->save();

        $city = new City;
        $city->name = ['en' => 'Jeddah', 'ar' => 'جده'];
        $city->save();

        $city = new City;
        $city->name = ['en' => 'Dammam', 'ar' => 'الدمام'];
        $city->save();
    }
}
