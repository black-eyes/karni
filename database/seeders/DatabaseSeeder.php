<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Operation;
use App\Models\Shop;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        //clear the database
        DB::table('operations')->truncate();
        DB::table('clients')->truncate();
        DB::table('shops')->truncate();


        $faker = \Faker\Factory::create();

        // get the current date
        $now = date('Y-m-d H:i:s');



        //create 5 shops
        //this array is used to store all created shops and use them to create clients
        $shops = array();

        for ($i=1;$i<=5;$i++)
        {
            $shop = new Shop();
            $shop::create([
                "shop_name"=>$faker->sentence(1)."--".$i,
                "phone_no"=>$faker->phoneNumber,
                "app_lang"=>$faker->languageCode,
                "password"=>$faker->sentence(1),
            ]);

            $id= DB::getPdo()->lastInsertId();

            array_push($shops,$id);
        }



        //create 10 clients

        //this array is used to store all created clients and use them to create operations
        $clients = array();

        for ($i=0; $i<10;$i++)
        {
            $client = new Client();
            $client::create([
                "client_name"=>$faker->firstName(1),
                "client_phone_no"=>$faker->phoneNumber,
                "shop_id"=>$shops[array_rand($shops)]
            ]);

            $id= DB::getPdo()->lastInsertId();

            array_push($clients,$id);
        }

        //create 100 operations for an existent clients
        $optType = ["sortie","entree"];
        for($i=0; $i<100;$i++)
        {
            $operation = new Operation();
            $operation::create(
                [
                    "client_id"=>$clients[array_rand($clients)],
                    "type_operation"=>$optType[array_rand($optType)],
                    "note_operation"=>$faker->text(),
                    "date_operation"=>$now,
                    "image_operation"=>$faker->text,
                    "amount"=>$faker->randomFloat(4,1,9999)
                ]);
        }



    }
}
