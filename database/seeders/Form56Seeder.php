<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Form56Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('form56s')->insert([
            ['effectivity_year'=>'2', 'tax_precentage'=>'3', 'aid_in_full'=>'1', 'paid_in_full'=>'5', 'penalty_per_month'=>'2.3', 'created_at'=>now(), 'updated_at'=>now()]
        ]);
    }
}
