<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollectionRatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('collection_rates')->insert([

            //BAC
            [
                'acc_titles_id'=>'1',
                'acc_subtitles_id'=>null,
                'rate_change_id'=>'1',
                'shared_status'=>'0',	
                'provincial_share'=>null,
                'municipal_share'=>null,	
                'barangay_share'=>null,	
                'rate_type'=>'Schedule',	
                'fixed_rate'=>null,	
                'percent_value'=>null,	
                'percent_of'=>null,
                'deadline_status'=>null,
                'rate_after_deadline'=>null,	
                'deadline_date'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()
            ],

            [
                'acc_titles_id'=>'2',
                'acc_subtitles_id'=>null,
                'rate_change_id'=>'1',
                'shared_status'=>'0',	
                'provincial_share'=>null,
                'municipal_share'=>null,	
                'barangay_share'=>null,	
                'rate_type'=>'Schedule',	
                'fixed_rate'=>null,	
                'percent_value'=>null,	
                'percent_of'=>null,
                'deadline_status'=>null,
                'rate_after_deadline'=>null,	
                'deadline_date'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()
            ],

            [
                'acc_titles_id'=>'3',
                'acc_subtitles_id'=>null,
                'rate_change_id'=>'1',
                'shared_status'=>'0',	
                'provincial_share'=>null,
                'municipal_share'=>null,	
                'barangay_share'=>null,	
                'rate_type'=>'Schedule',	
                'fixed_rate'=>null,	
                'percent_value'=>null,	
                'percent_of'=>null,
                'deadline_status'=>null,
                'rate_after_deadline'=>null,	
                'deadline_date'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()
            ],

            //Tax Revenue
            // Professional Tax
            [
                'acc_titles_id'=>'4',
                'acc_subtitles_id'=>null,
                'rate_change_id'=>'1',
                'shared_status'=>'0',	
                'provincial_share'=>null,
                'municipal_share'=>null,	
                'barangay_share'=>null,	
                'rate_type'=>'Schedule',	
                'fixed_rate'=>null,	
                'percent_value'=>null,	
                'percent_of'=>null,
                'deadline_status'=>null,
                'rate_after_deadline'=>null,	
                'deadline_date'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()
            ],

            // Real Property Transfer Tax

            [
                'acc_titles_id'=>'6',
                'acc_subtitles_id'=>null,
                'rate_change_id'=>'1',
                'shared_status'=>'0',	
                'provincial_share'=>null,
                'municipal_share'=>null,	
                'barangay_share'=>null,	
                'rate_type'=>'Percent',	
                'fixed_rate'=>null,	
                'percent_value'=>'50.00',	
                'percent_of'=>'Given Value',
                'deadline_status'=>'0',
                'rate_after_deadline'=>null,	
                'deadline_date'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()
            ],

            // Tax on Sand, Gravel & Other Quarry Prod.

            [
                'acc_titles_id'=>'7',
                'acc_subtitles_id'=>null,
                'rate_change_id'=>'1',
                'shared_status'=>'1',	
                'provincial_share'=>'30.00',
                'municipal_share'=>'30.00',	
                'barangay_share'=>'40.00',	
                'rate_type'=>'Schedule',	
                'fixed_rate'=>null,	
                'percent_value'=>null,	
                'percent_of'=>null,
                'deadline_status'=>null,
                'rate_after_deadline'=>null,	
                'deadline_date'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()
            ],

            // Tax on Delivery Trucks & Vans

            [
                'acc_titles_id'=>'8',
                'acc_subtitles_id'=>null,
                'rate_change_id'=>'1',
                'shared_status'=>'0',	
                'provincial_share'=>null,
                'municipal_share'=>null,	
                'barangay_share'=>null,	
                'rate_type'=>'Schedule',	
                'fixed_rate'=>null,	
                'percent_value'=>null,	
                'percent_of'=>null,
                'deadline_status'=>null,
                'rate_after_deadline'=>null,	
                'deadline_date'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()
            ],

            // Amusement Tax

            [
                'acc_titles_id'=>'9',
                'acc_subtitles_id'=>null,
                'rate_change_id'=>'1',
                'shared_status'=>'1',	
                'provincial_share'=>'50.00',
                'municipal_share'=>'50.00',	
                'barangay_share'=>'0.00',	
                'rate_type'=>'Percent',	
                'fixed_rate'=>null,	
                'percent_value'=>'50.00',	
                'percent_of'=>'Given Value',
                'deadline_status'=>'0',
                'rate_after_deadline'=>null,	
                'deadline_date'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()
            ],

            // Franchise Tax

            [
                'acc_titles_id'=>'10',
                'acc_subtitles_id'=>null,
                'rate_change_id'=>'1',
                'shared_status'=>'0',	
                'provincial_share'=>null,
                'municipal_share'=>null,	
                'barangay_share'=>null,	
                'rate_type'=>'Percent',	
                'fixed_rate'=>null,	
                'percent_value'=>'50.00',	
                'percent_of'=>'Given Value',
                'deadline_status'=>'0',
                'rate_after_deadline'=>null,	
                'deadline_date'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()
            ],

            // Printing and Publication Tax

            [
                'acc_titles_id'=>'11',
                'acc_subtitles_id'=>null,
                'rate_change_id'=>'1',
                'shared_status'=>'0',	
                'provincial_share'=>null,
                'municipal_share'=>null,	
                'barangay_share'=>null,	
                'rate_type'=>'Percent',	
                'fixed_rate'=>null,	
                'percent_value'=>'50.00',	
                'percent_of'=>'Given Value',
                'deadline_status'=>'1',
                'rate_after_deadline'=>'2.00',	
                'deadline_date'=>'01/21',	
                'created_at'=>now(),	
                'updated_at'=>now()
            ],

            // Other Taxes (Mining Claims)

            [
                'acc_titles_id'=>'12',
                'acc_subtitles_id'=>null,
                'rate_change_id'=>'1',
                'shared_status'=>'0',	
                'provincial_share'=>null,
                'municipal_share'=>null,	
                'barangay_share'=>null,	
                'rate_type'=>'Manual',	
                'fixed_rate'=>null,	
                'percent_value'=>null,	
                'percent_of'=>null,
                'deadline_status'=>null,
                'rate_after_deadline'=>null,	
                'deadline_date'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()
            ],

            // Tax Revenue - Fines & Penalties - on Individual (PTR)

            [
                'acc_titles_id'=>'13',
                'acc_subtitles_id'=>null,
                'rate_change_id'=>'1',
                'shared_status'=>'0',	
                'provincial_share'=>null,
                'municipal_share'=>null,	
                'barangay_share'=>null,	
                'rate_type'=>'Percent',	
                'fixed_rate'=>null,	
                'percent_value'=>'25.00',	
                'percent_of'=>'Total',
                'deadline_status'=>'1',
                'rate_after_deadline'=>'2.00',	
                'deadline_date'=>'01/01',	
                'created_at'=>now(),	
                'updated_at'=>now()
            ],

            // Tax Revenue - Fines & Penalties - Property Taxes

            [
                'acc_titles_id'=>'14',
                'acc_subtitles_id'=>null,
                'rate_change_id'=>'1',
                'shared_status'=>'0',	
                'provincial_share'=>null,
                'municipal_share'=>null,	
                'barangay_share'=>null,	
                'rate_type'=>'Percent',	
                'fixed_rate'=>null,	
                'percent_value'=>'25.00',	
                'percent_of'=>'Total',
                'deadline_status'=>'1',
                'rate_after_deadline'=>'2.00',	
                'deadline_date'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()
            ],

            // Tax Revenue-Fines & Penalties - Real Property Taxes

            // [
            //     'acc_titles_id'=>'15',
            //     'acc_subtitles_id'=>null,
            //     'rate_change_id'=>'1',
            //     'shared_status'=>'0',	
            //     'provincial_share'=>null,
            //     'municipal_share'=>null,	
            //     'barangay_share'=>null,	
            //     'rate_type'=>'Percent',	
            //     'fixed_rate'=>null,	
            //     'percent_value'=>'25.00',	
            //     'percent_of'=>'Total',
            //     'deadline_status'=>'1',
            //     'rate_after_deadline'=>'2.00',	
            //     'deadline_date'=>null,	
            //     'created_at'=>now(),	
            //     'updated_at'=>now()
            // ],

            // Tax Revenue - Fines & Penalties - Goods & Services

            [
                'acc_titles_id'=>'16',
                'acc_subtitles_id'=>null,
                'rate_change_id'=>'1',
                'shared_status'=>'0',	
                'provincial_share'=>null,
                'municipal_share'=>null,	
                'barangay_share'=>null,	
                'rate_type'=>'Percent',	
                'fixed_rate'=>null,	
                'percent_value'=>'25.00',	
                'percent_of'=>'Total',
                'deadline_status'=>'1',
                'rate_after_deadline'=>'2.00',	
                'deadline_date'=>'01/20',	
                'created_at'=>now(),	
                'updated_at'=>now()
            ],

            // Service Income
                // Permit Fees
            [
                'acc_titles_id'=>'19',
                'acc_subtitles_id'=>null,
                'rate_change_id'=>'1',
                'shared_status'=>'0',	
                'provincial_share'=>null,
                'municipal_share'=>null,	
                'barangay_share'=>null,	
                'rate_type'=>'Schedule',	
                'fixed_rate'=>null,	
                'percent_value'=>null,	
                'percent_of'=>null,
                'deadline_status'=>null,
                'rate_after_deadline'=>null,	
                'deadline_date'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()
            ],

            // Clearance & Certification Fees

            [
                'acc_titles_id'=>'20',
                'acc_subtitles_id'=>null,
                'rate_change_id'=>'1',
                'shared_status'=>'0',	
                'provincial_share'=>null,
                'municipal_share'=>null,	
                'barangay_share'=>null,	
                'rate_type'=>'Schedule',	
                'fixed_rate'=>null,	
                'percent_value'=>null,	
                'percent_of'=>null,
                'deadline_status'=>null,
                'rate_after_deadline'=>null,	
                'deadline_date'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()
            ],

            // Supervision and Regulation, Enforcement Fees (Quarantine Fees)
            [
                'acc_titles_id'=>'21',
                'acc_subtitles_id'=>null,
                'rate_change_id'=>'1',
                'shared_status'=>'0',	
                'provincial_share'=>null,
                'municipal_share'=>null,	
                'barangay_share'=>null,	
                'rate_type'=>'Schedule',	
                'fixed_rate'=>null,	
                'percent_value'=>null,	
                'percent_of'=>null,
                'deadline_status'=>null,
                'rate_after_deadline'=>null,	
                'deadline_date'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()
            ],

            // Verfication & Authentication Fees

            [
                'acc_titles_id'=>'22',
                'acc_subtitles_id'=>null,
                'rate_change_id'=>'1',
                'shared_status'=>'0',	
                'provincial_share'=>null,
                'municipal_share'=>null,	
                'barangay_share'=>null,	
                'rate_type'=>'Schedule',	
                'fixed_rate'=>null,	
                'percent_value'=>null,	
                'percent_of'=>null,
                'deadline_status'=>null,
                'rate_after_deadline'=>null,	
                'deadline_date'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()
            ],

            // Fines & Penalties - Service Income (General Fund-Proper)

            [
                'acc_titles_id'=>'24',
                'acc_subtitles_id'=>null,
                'rate_change_id'=>'1',
                'shared_status'=>'0',	
                'provincial_share'=>null,
                'municipal_share'=>null,	
                'barangay_share'=>null,	
                'rate_type'=>'Percent',	
                'fixed_rate'=>null,	
                'percent_value'=>'25.00',	
                'percent_of'=>'Total',
                'deadline_status'=>'1',
                'rate_after_deadline'=>'2.00',	
                'deadline_date'=>'01/20',	
                'created_at'=>now(),	
                'updated_at'=>now()
            ],

            // // Other Service Income (NO SET RATE) 25

            // // Business Income
            //     // Afiliation Fees (NO SET RATE) 26
            //     // Rent Income (NO SET RATE) 27
                
                // General (Buildings / Lots / Lights & Water)
            [
                'acc_titles_id'=>null,
                'acc_subtitles_id'=>'1',
                'rate_change_id'=>'1',
                'shared_status'=>'0',	
                'provincial_share'=>null,
                'municipal_share'=>null,	
                'barangay_share'=>null,	
                'rate_type'=>'Schedule',
                'fixed_rate'=>null,	
                'percent_value'=>null,	
                'percent_of'=>null,
                'deadline_status'=>null,
                'rate_after_deadline'=>null,	
                'deadline_date'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()
            ],

                // Benguet Cold Chain Operation
            [
                'acc_titles_id'=>null,
                'acc_subtitles_id'=>'2',
                'rate_change_id'=>'1',
                'shared_status'=>'0',	
                'provincial_share'=>null,
                'municipal_share'=>null,	
                'barangay_share'=>null,	
                'rate_type'=>'Schedule',	
                'fixed_rate'=>null,	
                'percent_value'=>null,	
                'percent_of'=>null,
                'deadline_status'=>null,
                'rate_after_deadline'=>null,	
                'deadline_date'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()
            ],

            // Sales on Agricultural Products (BPENRO)
            [
                'acc_titles_id'=>null,
                'acc_subtitles_id'=>'5',
                'rate_change_id'=>'1',
                'shared_status'=>'0',	
                'provincial_share'=>null,
                'municipal_share'=>null,	
                'barangay_share'=>null,	
                'rate_type'=>'Schedule',	
                'fixed_rate'=>null,	
                'percent_value'=>null,	
                'percent_of'=>null,
                'deadline_status'=>null,
                'rate_after_deadline'=>null,	
                'deadline_date'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()
            ],

            // Sale on Delivery Receipts / Books / Appl. Fees
            [
                'acc_titles_id'=>null,
                'acc_subtitles_id'=>'7',
                'rate_change_id'=>'1',
                'shared_status'=>'0',	
                'provincial_share'=>null,
                'municipal_share'=>null,	
                'barangay_share'=>null,	
                'rate_type'=>'Schedule',	
                'fixed_rate'=>null,	
                'percent_value'=>null,	
                'percent_of'=>null,
                'deadline_status'=>null,
                'rate_after_deadline'=>null,	
                'deadline_date'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()
            ],

            // Sales on Veterinary Products
            [
                'acc_titles_id'=>null,
                'acc_subtitles_id'=>'8',
                'rate_change_id'=>'1',
                'shared_status'=>'0',	
                'provincial_share'=>null,
                'municipal_share'=>null,	
                'barangay_share'=>null,	
                'rate_type'=>'Schedule',	
                'fixed_rate'=>null,	
                'percent_value'=>null,	
                'percent_of'=>null,
                'deadline_status'=>null,
                'rate_after_deadline'=>null,	
                'deadline_date'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()
            ],

            // Fines & Penalties - Business Income (General Fund-Proper)
            [
                'acc_titles_id'=>'33',
                'acc_subtitles_id'=>null,
                'rate_change_id'=>'1',
                'shared_status'=>'0',	
                'provincial_share'=>null,
                'municipal_share'=>null,	
                'barangay_share'=>null,	
                'rate_type'=>'Percent',	
                'fixed_rate'=>null,	
                'percent_value'=>'10.00',	
                'percent_of'=>'Total',
                'deadline_status'=>'1',
                'rate_after_deadline'=>'2.00',	
                'deadline_date'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()
            ],

            // Miscellaneous Income
            [
                'acc_titles_id'=>'37',
                'acc_subtitles_id'=>null,
                'rate_change_id'=>'1',
                'shared_status'=>'0',	
                'provincial_share'=>null,
                'municipal_share'=>null,	
                'barangay_share'=>null,	
                'rate_type'=>'Schedule',	
                'fixed_rate'=>null,	
                'percent_value'=>null,	
                'percent_of'=>null,
                'deadline_status'=>null,
                'rate_after_deadline'=>null,	
                'deadline_date'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()
            ],

            // School Fees
            [
                'acc_titles_id'=>'27',
                'acc_subtitles_id'=>null,
                'rate_change_id'=>'1',
                'shared_status'=>'0',	
                'provincial_share'=>null,
                'municipal_share'=>null,	
                'barangay_share'=>null,	
                'rate_type'=>'Schedule',	
                'fixed_rate'=>null,	
                'percent_value'=>null,	
                'percent_of'=>null,
                'deadline_status'=>null,
                'rate_after_deadline'=>null,	
                'deadline_date'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()
            ],

            // Registration Fees
            [
                'acc_titles_id'=>'40',
                'acc_subtitles_id'=>null,
                'rate_change_id'=>'1',
                'shared_status'=>'0',	
                'provincial_share'=>null,
                'municipal_share'=>null,	
                'barangay_share'=>null,	
                'rate_type'=>'Fixed',	
                'fixed_rate'=>'350',	
                'percent_value'=>null,	
                'percent_of'=>null,
                'deadline_status'=>null,
                'rate_after_deadline'=>null,	
                'deadline_date'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()
            ],

            // Clearance and Certification Fees
            [
                'acc_titles_id'=>'41',
                'acc_subtitles_id'=>null,
                'rate_change_id'=>'1',
                'shared_status'=>'0',	
                'provincial_share'=>null,
                'municipal_share'=>null,	
                'barangay_share'=>null,	
                'rate_type'=>'Fixed',	
                'fixed_rate'=>'100',	
                'percent_value'=>null,	
                'percent_of'=>null,
                'deadline_status'=>null,
                'rate_after_deadline'=>null,	
                'deadline_date'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()
            ],

            // Insurance Premium
            [
                'acc_titles_id'=>'42',
                'acc_subtitles_id'=>null,
                'rate_change_id'=>'1',
                'shared_status'=>'0',	
                'provincial_share'=>null,
                'municipal_share'=>null,	
                'barangay_share'=>null,	
                'rate_type'=>'Fixed',	
                'fixed_rate'=>'50',	
                'percent_value'=>null,	
                'percent_of'=>null,
                'deadline_status'=>null,
                'rate_after_deadline'=>null,	
                'deadline_date'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()
            ]
        ]);
    }
}
