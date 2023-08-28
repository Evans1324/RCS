<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CertOfficersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cert_officers')->insert([
            [
                'officer_id'=>'1',
                'position_id'=>'1',
                'department_id'=>'1',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'officer_id'=>'2',
                'position_id'=>'2',
                'department_id'=>'1',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'officer_id'=>'3',
                'position_id'=>'3',
                'department_id'=>'1',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'officer_id'=>'4',
                'position_id'=>'4',
                'department_id'=>'1',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'officer_id'=>'5',
                'position_id'=>'5',
                'department_id'=>'1',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'officer_id'=>'6',
                'position_id'=>'6',
                'department_id'=>'1',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'officer_id'=>'7',
                'position_id'=>'7',
                'department_id'=>'2',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
        ]);
    }
}
