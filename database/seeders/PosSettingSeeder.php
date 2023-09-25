<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PosSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pos_settings')->insert([
            [ 
                'shop_name' => 'easySolutions POS',
                'shop_moto' => 'Not Number One, WE are Only One',
                'shop_phone' => '01729867026',
                'shop_email' => 'sourov.okk@gmail.com',
                'language' => 'en',
                'customer_due' => 'yes',
                'supplier_due' => 'yes',
                'logo' => 'image/techbot_logo.png',
            ],
         
        ]);

    }
}
