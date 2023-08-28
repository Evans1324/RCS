<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SerialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('serials')->insert([
            [
                'start_serial'=>'1',
                'end_serial'=>'10',
                'form'=>'Form 51',
                'unit'=>'Continuous',
                'fund_id'=>'1',
                'mun_id'=>null,
                'acc_officer_id'=>null,
                'created_at'=>now(),
                'updated_at'=>now()
            ],

        //     [
        //         'start_serial'=>'1000',
        //         'end_serial'=>'1010',
        //         'form'=>'Form 51',
        //         'unit'=>'Continuous',
        //         'fund_id'=>'1',
        //         'mun_id'=>null,
        //         'acc_officer_id'=>null,
        //         'created_at'=>now(),
        //         'updated_at'=>now()
        //     ],

        //     [
        //         'start_serial'=>'2000',
        //         'end_serial'=>'2010',
        //         'form'=>'Form 51',
        //         'unit'=>'Continuous',
        //         'fund_id'=>'1',
        //         'mun_id'=>null,
        //         'acc_officer_id'=>null,
        //         'created_at'=>now(),
        //         'updated_at'=>now()
        //     ],

        //     [
        //         'start_serial'=>'3000',
        //         'end_serial'=>'3010',
        //         'form'=>'Form 51',
        //         'unit'=>'Continuous',
        //         'fund_id'=>'1',
        //         'mun_id'=>null,
        //         'acc_officer_id'=>null,
        //         'created_at'=>now(),
        //         'updated_at'=>now()
        //     ],

        //     [
        //         'start_serial'=>'4000',
        //         'end_serial'=>'4010',
        //         'form'=>'Form 51',
        //         'unit'=>'Continuous',
        //         'fund_id'=>'1',
        //         'mun_id'=>null,
        //         'acc_officer_id'=>null,
        //         'created_at'=>now(),
        //         'updated_at'=>now()
        //     ],

        //     [
        //         'start_serial'=>'5000',
        //         'end_serial'=>'5010',
        //         'form'=>'Form 51',
        //         'unit'=>'Continuous',
        //         'fund_id'=>'1',
        //         'mun_id'=>null,
        //         'acc_officer_id'=>null,
        //         'created_at'=>now(),
        //         'updated_at'=>now()
        //     ],
        ]);
    }
}
