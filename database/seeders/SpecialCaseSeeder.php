<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialCaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('special_cases')->insert([
            [
                'source_barangay'=>'Tuba-Camp 1',
                'source_percentage'=>72,
                'barangay_sharing'=>'Tuba-Tabaan Sur',
                'percentage_sharing'=>28,
                'effectivity_date'=>null,
                'effectivity_end_date'=>null,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
        ]);
    }
}
