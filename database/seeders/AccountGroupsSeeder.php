<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('account_groups')->insert([

            // General Fund-Proper
            [
                'type'=>'Tax Revenue', 
                'category_id'=>'1', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'type'=>'Service Income', 
                'category_id'=>'1', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'type'=>'Business Income', 
                'category_id'=>'1', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'type'=>'Share, Grants & Donations/Gains/Misc. Income', 
                'category_id'=>'1', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'type'=>'Accounts Payable',
                'category_id'=>'1', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            // Benguet Technical School (BTS)
            // [
            //     'type'=>'Business Income',
            //     'category_id'=>'2', 
            //     'created_at'=>now(), 
            //     'updated_at'=>now()
            // ],

            // [
            //     'type'=>'Service Income',
            //     'category_id'=>'2', 
            //     'created_at'=>now(), 
            //     'updated_at'=>now()
            // ],

            // [
            //     'type'=>'Transfers, Assistance & Subsidy/Gain/Misc. Income',
            //     'category_id'=>'2', 
            //     'created_at'=>now(), 
            //     'updated_at'=>now()
            // ],

            // [
            //     'type'=>'Expenses',
            //     'category_id'=>'2', 
            //     'created_at'=>now(), 
            //     'updated_at'=>now()
            // ],

            // [
            //     'type'=>'Accounts Payable',
            //     'category_id'=>'2', 
            //     'created_at'=>now(), 
            //     'updated_at'=>now()
            // ],

            // [
            //     'type'=>'Accounts Receivable',
            //     'category_id'=>'2', 
            //     'created_at'=>now(), 
            //     'updated_at'=>now()
            // ],

            // Special Education Fund (SEF)
            [
                'type'=>'Tax Revenue',
                'category_id'=>'2', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            // Trust Fund
            [
                'type'=>'Particulars',
                'category_id'=>'3', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],
        ]);
    }
}
