<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfficersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('officers')->insert([
            [
                'name'=>'IMELDA I. MACANES',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'name'=>'JOANA G. COLSIM',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'name'=>'MARY JANE P. LAMPACAN',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'name'=>'ODELIA P. SINAS',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'name'=>'JULIE V. ESTEBAN',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'name'=>'IRENE C. BAGKING',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'name'=>'MELCHOR D. DICLAS, MD',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
        ]);
    }
}
