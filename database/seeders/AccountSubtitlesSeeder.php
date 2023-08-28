<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountSubtitlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('account_subtitles')->insert([
                // Rent Income
            [
                'title_id'=>'27', 
                'subtitle'=>'General (Buildings/Lots/Light & Water)', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_id'=>'27', 
                'subtitle'=>'Benguet Cold Chain Operation', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_id'=>'27', 
                'subtitle'=>'Lodging (OPAG)', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_id'=>'27', 
                'subtitle'=>'Provincial Health Office (PHO)', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

               // Sales Revenue
            [
                'title_id'=>'28', 
                'subtitle'=>'Sales on Agricultural Products (BPENRO)', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_id'=>'28', 
                'subtitle'=>'Sales on Agricultural Products (OPAG)', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_id'=>'28', 
                'subtitle'=>'Sale on Delivery Receipts / Books / Appl. Fees', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_id'=>'28', 
                'subtitle'=>'Sales on Veterinary Products', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_id'=>'28', 
                'subtitle'=>'Gain on Sale of Accountable Forms/Printed forms', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_id'=>'28', 
                'subtitle'=>'Gain on Sale of Drugs and Medicines-5 District Hospitals', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

                // Hospital Fees
            [
                'title_id'=>'29', 
                'subtitle'=>'Medical, Dental, X-Ray & Laboratory', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            // Benguet Technical School (BTS)
                // Accounts Payable
                    // Miscellaneous Income
            // [
            //     'title_id'=>'51', 
            //     'subtitle'=>'Other Payables (BTS)', 
            //     'created_at'=>now(), 
            //     'updated_at'=>now()
            // ],
        ]);
    }
}
