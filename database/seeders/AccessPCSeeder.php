<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccessPCSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('access_p_c_s')->insert([

            ['pc_name'=>'PC UNIT O',
            'assigned_ip'=>'192.168.6.75',
            'process_type'=>'Land Tax Collection',
            'process_form'=>'Form 51',
            'serial_id'=>'1',
            'created_at'=>now(),
            'updated_at'=>now()],

        //     ['pc_name'=>'Mark',
        //     'assigned_ip'=>'192.168.4.240',
        //     'process_type'=>'Land Tax Collection',
        //     'process_form'=>'Form 51',
        //     'serial_id'=>'2',
        //     'created_at'=>now(),
        //     'updated_at'=>now()],

        //     ['pc_name'=>'Badz',
        //     'assigned_ip'=>'192.168.4.234',
        //     'process_type'=>'Land Tax Collection',
        //     'process_form'=>'Form 51',
        //     'serial_id'=>'3',
        //     'created_at'=>now(),
        //     'updated_at'=>now()],

        //     ['pc_name'=>'Maryann',
        //     'assigned_ip'=>'192.168.4.239',
        //     'process_type'=>'Land Tax Collection',
        //     'process_form'=>'Form 51',
        //     'serial_id'=>'4',
        //     'created_at'=>now(),
        //     'updated_at'=>now()],

        //     ['pc_name'=>'Kristel',
        //     'assigned_ip'=>'192.168.4.233',
        //     'process_type'=>'Land Tax Collection',
        //     'process_form'=>'Form 51',
        //     'serial_id'=>'5',
        //     'created_at'=>now(),
        //     'updated_at'=>now()],

        //     ['pc_name'=>'Riza',
        //     'assigned_ip'=>'192.168.4.231',
        //     'process_type'=>'Land Tax Collection',
        //     'process_form'=>'Form 51',
        //     'serial_id'=>'6',
        //     'created_at'=>now(),
        //     'updated_at'=>now()],
        ]);
    }
}
