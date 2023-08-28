<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            [
                'department'=>'PTO',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'department'=>'PGO',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
        ]);
    }
}
