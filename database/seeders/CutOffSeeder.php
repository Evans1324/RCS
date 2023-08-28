<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CutOffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cut_offs')->insert([
            ['collection_cutoff'=>'12:00', 'created_at'=>now(), 'updated_at'=>now()]
        ]);
    }
}
