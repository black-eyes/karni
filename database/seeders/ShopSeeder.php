<?php

namespace Database\Seeders;

use App\Models\Shop;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = \Faker\Factory::create();
        for ($i = 0 ; $i<100 ; $i++)
        {
            Shop::create(
                [
                    "shop_name"=>$faker->sentence(1),
                    "phone_no"=>$faker->phoneNumber,
                    "app_lang"=>$faker->languageCode,
                    "password"=>$faker->sentence(10)
                 ]);
        }
    }
}
