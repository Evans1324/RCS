<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MunicipalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('municipalities')->insert([
            ['municipality'=>'Atok', 'created_at'=>now(), 'updated_at'=>now()], //separate array "[]" holders for each data 
            ['municipality'=>'Bakun', 'created_at'=>now(), 'updated_at'=>now()],
            ['municipality'=>'Bokod', 'created_at'=>now(), 'updated_at'=>now()],
            ['municipality'=>'Buguias', 'created_at'=>now(), 'updated_at'=>now()],
            ['municipality'=>'Itogon', 'created_at'=>now(), 'updated_at'=>now()],
            ['municipality'=>'Kabayan', 'created_at'=>now(), 'updated_at'=>now()],
            ['municipality'=>'Kapangan', 'created_at'=>now(), 'updated_at'=>now()],
            ['municipality'=>'Kibungan', 'created_at'=>now(), 'updated_at'=>now()],
            ['municipality'=>'La Trinidad', 'created_at'=>now(), 'updated_at'=>now()],
            ['municipality'=>'Mankayan', 'created_at'=>now(), 'updated_at'=>now()],
            ['municipality'=>'Sablan', 'created_at'=>now(), 'updated_at'=>now()],
            ['municipality'=>'Tuba', 'created_at'=>now(), 'updated_at'=>now()],
            ['municipality'=>'Tublay', 'created_at'=>now(), 'updated_at'=>now()],
            ['municipality'=>'Other', 'created_at'=>now(), 'updated_at'=>now()]
        ]);
    }
}
