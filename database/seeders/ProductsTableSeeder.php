<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Car;
use App\Models\Category;
use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $category->parent_id = 1;
        $category->name = ['en' => 'Meat', 'ar' => 'لحم'];
        $category->save();

        $category = new Category();
        $category->parent_id = 1;
        $category->name = ['en' => 'Chicken', 'ar' => 'دجاج'];
        $category->save();

        $category = new Category();
        $category->parent_id = 1;
        $category->name = ['en' => 'Bread', 'ar' => 'عيش'];
        $category->save();

        $category = new Category();
        $category->parent_id = 1;
        $category->name = ['en' => 'Oil', 'ar' => 'زيت'];
        $category->save();

        $category = new Category();
        $category->parent_id = 1;
        $category->name = ['en' => 'Milk', 'ar' => 'حليب'];
        $category->save();

        /////////////////////////

        $category = new Category();
        $category->parent_id = 2;
        $category->name = ['en' => 'Fountain pen and pencil', 'ar' => 'قلم حبر ورصاص'];
        $category->save();

        $category = new Category();
        $category->parent_id = 2;
        $category->name = ['en' => 'Copy Paper', 'ar' => 'ورق تصوير'];
        $category->save();

        $category = new Category();
        $category->parent_id = 2;
        $category->name = ['en' => 'Stapler Staples', 'ar' => 'دباسة دبابيس'];
        $category->save();

        $category = new Category();
        $category->parent_id = 2;
        $category->name = ['en' => 'Buckle', 'ar' => 'مشبك'];
        $category->save();

        $category = new Category();
        $category->parent_id = 2;
        $category->name = ['en' => 'Ruler', 'ar' => 'مسطرة'];
        $category->save();

        /////////////////////////

        $category = new Category();
        $category->parent_id = 3;
        $category->name = ['en' => 'Faucet', 'ar' => 'حنفية'];
        $category->save();

        $category = new Category();
        $category->parent_id = 3;
        $category->name = ['en' => 'Bidet', 'ar' => 'شطاف'];
        $category->save();

        $category = new Category();
        $category->parent_id = 3;
        $category->name = ['en' => 'Bath set', 'ar' => 'طقم حمام'];
        $category->save();
    }
}
