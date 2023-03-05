<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Car;
use App\Models\Category;
use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $city = new Category();
        $city->name = ['en' => 'Foodstuffs', 'ar' => 'مواد غذائية'];
        $city->save();

        $city = new Category();
        $city->name = ['en' => 'stationery', 'ar' => 'أدوات مكتبية'];
        $city->save();

        $city = new Category();
        $city->name = ['en' => 'Sanitary and electrical tools', 'ar' => 'أدوات صحية وكهربائية'];
        $city->save();
    }
}
