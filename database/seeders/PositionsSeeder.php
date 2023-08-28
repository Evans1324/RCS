<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('positions')->insert([
            [
                'position'=>'Provincial Treasurer',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'position'=>'Local Revenue Collection Officer III',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'position'=>'Local Revenue Collection Officer IV',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'position'=>'Local Revenue Collection Officer I',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'position'=>'Assistant Provincial Treasurer',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'position'=>'Supervising Administrative Officer',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'position'=>'Provincial Governor',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
        ]);
    }
}
