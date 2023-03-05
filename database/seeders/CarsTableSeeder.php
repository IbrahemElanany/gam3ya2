<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Car;
use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $city = new Car();
        $city->name = ['en' => 'Fiat Tipo', 'ar' => 'فيات تيبو'];
        $city->save();

        $city = new City;
        $city->name = ['en' => 'Kia Sportage', 'ar' => 'كيا سبورتاج'];
        $city->save();

        $city = new City;
        $city->name = ['en' => 'Hyundai Elantra', 'ar' => 'هيونداي النترا'];
        $city->save();
    }
}
