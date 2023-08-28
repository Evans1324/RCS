<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            [
                'acc_category_settings'=>'General Fund-Proper', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            // [
            //     'acc_category_settings'=>'Benguet Technical School (BTS)', 
            //     'created_at'=>now(), 
            //     'updated_at'=>now()
            // ],

            [
                'acc_category_settings'=>'Special Education Fund (SEF)', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'acc_category_settings'=>'Trust Fund', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],
        ]);
    }
}
