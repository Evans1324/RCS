<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RateChangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rate_changes')->insert([
            [	
            'date_of_change'=>'12/22/2021',
            'created_at'=>now(),
            'updated_at'=>now()]
        ]);
        
    }
}
