<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountTitlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('account_titles')->insert([
            // General Fund-Proper
            [
                'title_code'=>'4-01-01-000', 
                'title_name'=>'BAC Drugs & Meds', 
                'title_category_id'=>'1', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_code'=>'4-01-01-001', 
                'title_name'=>'BAC Goods & Services', 
                'title_category_id'=>'1', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_code'=>'4-01-01-003', 
                'title_name'=>'BAC INFRA', 
                'title_category_id'=>'1', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],
            
            [
                'title_code'=>'4-01-01-020', 
                'title_name'=>'Professional Tax', 
                'title_category_id'=>'1', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],
            
            [
                'title_code'=>'4-01-02-040', 
                'title_name'=>'Professional Tax-Basic (Net of Discount)', 
                'title_category_id'=>'1', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_code'=>'4-01-02-080', 
                'title_name'=>'Real Property Transfer Tax', 
                'title_category_id'=>'1', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_code'=>'4-01-03-040', 
                'title_name'=>'Tax on Sand, Gravel & Other Quarry Prod.', 
                'title_category_id'=>'1', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_code'=>'4-03-01-050', 
                'title_name'=>'Tax on Delivery Trucks & Vans (General Fund-Proper)', 
                'title_category_id'=>'1', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_code'=>'4-03-01-060', 
                'title_name'=>'Amusement Tax', 
                'title_category_id'=>'1', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_code'=>'4-03-01-070', 
                'title_name'=>'Franchise Tax', 
                'title_category_id'=>'1', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_code'=>'4-03-01-080', 
                'title_name'=>'Printing and Publication Tax', 
                'title_category_id'=>'1', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_code'=>'4-01-04-990', 
                'title_name'=>'Other Taxes (Mining Claims)', 
                'title_category_id'=>'1', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_code'=>'4-01-05-010', 
                'title_name'=>'Tax Revenue - Fines & Penalties - on Individual (PTR)', 
                'title_category_id'=>'1', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_code'=>'4-01-05-020', 
                'title_name'=>'Tax Revenue - Fines & Penalties - Property Taxes', 
                'title_category_id'=>'1', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_code'=>'4-01-05-030', 
                'title_name'=>'Tax Revenue - Fines & Penalties - Real Property Taxes', 
                'title_category_id'=>'1', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_code'=>'4-01-05-040', 
                'title_name'=>'Tax Revenue - Fines & Penalties - Goods & Services', 
                'title_category_id'=>'1', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_code'=>'4-01-06-010', 
                'title_name'=>'Share from Internal Revenue Collections (IRA)', 
                'title_category_id'=>'1', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_code'=>'4-01-06-030', 
                'title_name'=>'Share from National Wealth-Hydro', 
                'title_category_id'=>'1', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

                // Service Income

            [
                'title_code'=>'4-02-01-010', 
                'title_name'=>'Permit Fees', 
                'title_category_id'=>'2', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_code'=>'4-02-01-040', 
                'title_name'=>'Clearance & Certification Fees (General Fund-Proper)', 
                'title_category_id'=>'2', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_code'=>'4-02-01-050', 
                'title_name'=>'Supervision and Regulation, Enforcement Fees (Quarantine Fees)', 
                'title_category_id'=>'2', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_code'=>'4-02-01-110', 
                'title_name'=>'Verification & Authentication Fees', 
                'title_category_id'=>'2', 
                'created_at'=>now(),
                'updated_at'=>now()
            ],

            [
                'title_code'=>'4-02-01-070', 
                'title_name'=>'Sup & Reg. Enf Fees (Animal Quarantine Fees)', 
                'title_category_id'=>'2', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_code'=>'4-02-01-980', 
                'title_name'=>'Fines & Penalties - Service Income (General Fund-Proper)', 
                'title_category_id'=>'2', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_code'=>'4-02-01-990', 
                'title_name'=>'Other Services Income (General Fund-Proper)', 
                'title_category_id'=>'2', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_code'=>'4-02-02-200', 
                'title_name'=>'Registration Fees', 
                'title_category_id'=>'2', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

                // Bsuiness
            [
                'title_code'=>'4-02-02-200', 
                'title_name'=>'School Fees', 
                'title_category_id'=>'3', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_code'=>'4-02-02-020', 
                'title_name'=>'Affiliation Fees', 
                'title_category_id'=>'3', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_code'=>'4-02-02-050', 
                'title_name'=>'Rent Income', 
                'title_category_id'=>'3', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_code'=>'4-02-02-180', 
                'title_name'=>'Sales Revenue', 
                'title_category_id'=>'3', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_code'=>'4-02-02-200', 
                'title_name'=>'Hospital Fees', 
                'title_category_id'=>'3', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_code'=>'4-02-02-220', 
                'title_name'=>'Interest Income', 
                'title_category_id'=>'3', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_code'=>'4-02-02-980', 
                'title_name'=>'Fines & Penalties - Business Income (General Fund-Proper)', 
                'title_category_id'=>'3', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

                // Share, Grants & Donations/Gains/Misc. Income

            [
                'title_code'=>'4-04-02-010', 
                'title_name'=>'Grants & Donations (Financial Assistance)', 
                'title_category_id'=>'4', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_code'=>'4-04-01-020', 
                'title_name'=>'Share from PCSO (Lotto)', 
                'title_category_id'=>'4', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_code'=>'4-04-02-010', 
                'title_name'=>'Gain on Sale of Property, Plant & Rquipment', 
                'title_category_id'=>'4', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_code'=>'4-04-02-010', 
                'title_name'=>'Miscellaneous Income', 
                'title_category_id'=>'4', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

                // Accounts Payable

            [
                'title_code'=>'4-04-02-100', 
                'title_name'=>'Accounts Payable', 
                'title_category_id'=>'5', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            // Benguet Technical School (BTS)
            //     // Business Income (BTS)
            // [
            //     'title_code'=>'4-02-02-200', 
            //     'title_name'=>'School Fees', 
            //     'title_category_id'=>'6', 
            //     'created_at'=>now(), 
            //     'updated_at'=>now()
            // ],

            // [
            //     'title_code'=>'4-02-02-200', 
            //     'title_name'=>'Rent Income', 
            //     'title_category_id'=>'6', 
            //     'created_at'=>now(), 
            //     'updated_at'=>now()
            // ],

            // [
            //     'title_code'=>'4-02-02-200', 
            //     'title_name'=>'Interest Income', 
            //     'title_category_id'=>'6', 
            //     'created_at'=>now(), 
            //     'updated_at'=>now()
            // ],

            //     // Service Income (BTS)
            // [
            //     'title_code'=>'4-02-02-200', 
            //     'title_name'=>'Registration Fees', 
            //     'title_category_id'=>'7', 
            //     'created_at'=>now(), 
            //     'updated_at'=>now()
            // ],

            // [
            //     'title_code'=>'4-02-02-200', 
            //     'title_name'=>'Clearance and Certification Fees (BTS)', 
            //     'title_category_id'=>'7', 
            //     'created_at'=>now(), 
            //     'updated_at'=>now()
            // ],

            //     // Transfers, Assistance & Subsidy/Gain/Misc. Income

            // [
            //     'title_code'=>'4-02-02-200', 
            //     'title_name'=>'Insurance Premium', 
            //     'title_category_id'=>'8', 
            //     'created_at'=>now(), 
            //     'updated_at'=>now()
            // ],

            // [
            //     'title_code'=>'4-02-02-200', 
            //     'title_name'=>'Supplies and Materials', 
            //     'title_category_id'=>'8', 
            //     'created_at'=>now(), 
            //     'updated_at'=>now()
            // ],

            // [
            //     'title_code'=>'4-02-02-200', 
            //     'title_name'=>'Trainors Fee', 
            //     'title_category_id'=>'8', 
            //     'created_at'=>now(), 
            //     'updated_at'=>now()
            // ],

            // [
            //     'title_code'=>'4-02-02-200', 
            //     'title_name'=>'Transfer of Fund', 
            //     'title_category_id'=>'8', 
            //     'created_at'=>now(), 
            //     'updated_at'=>now()
            // ],

            // [
            //     'title_code'=>'4-02-02-200', 
            //     'title_name'=>'Subsidy from General Fund Proper', 
            //     'title_category_id'=>'8', 
            //     'created_at'=>now(), 
            //     'updated_at'=>now()
            // ],

            // [
            //     'title_code'=>'4-02-02-200', 
            //     'title_name'=>'Gain on Sale of Property, Plant & Equipment', 
            //     'title_category_id'=>'8', 
            //     'created_at'=>now(), 
            //     'updated_at'=>now()
            // ],

            // [
            //     'title_code'=>'4-02-02-200', 
            //     'title_name'=>'Assessment Fee', 
            //     'title_category_id'=>'8', 
            //     'created_at'=>now(), 
            //     'updated_at'=>now()
            // ],

            // [
            //     'title_code'=>'4-02-02-200', 
            //     'title_name'=>'Other Payables', 
            //     'title_category_id'=>'8', 
            //     'created_at'=>now(), 
            //     'updated_at'=>now()
            // ],

            //     // Expenses

            // [
            //     'title_code'=>'4-02-02-200', 
            //     'title_name'=>'Taxes, Duties & Licenses', 
            //     'title_category_id'=>'9', 
            //     'created_at'=>now(), 
            //     'updated_at'=>now()
            // ],

            //     // Accounts Payable
            // [
            //     'title_code'=>'4-02-02-200', 
            //     'title_name'=>'Miscellaneous Income', 
            //     'title_category_id'=>'10', 
            //     'created_at'=>now(), 
            //     'updated_at'=>now()
            // ],

            //     // Accounts Receivable
            // [
            //     'title_code'=>'4-02-02-200', 
            //     'title_name'=>'Accounts Receivable', 
            //     'title_category_id'=>'11', 
            //     'created_at'=>now(), 
            //     'updated_at'=>now()
            // ],

            // // 	Special Education Fund (SEF)

            [
                'title_code'=>'4-01-02-050', 
                'title_name'=>'Special Education Fund', 
                'title_category_id'=>'6', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            // [
            //     'title_code'=>'4-01-05-020', 
            //     'title_name'=>'Tax Revenue - Fines & Penalties-Real Property Taxes', 
            //     'title_category_id'=>'6', 
            //     'created_at'=>now(), 
            //     'updated_at'=>now()
            // ],

            [
                'title_code'=>'4-02-02-220', 
                'title_name'=>'Interest Income', 
                'title_category_id'=>'6', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_code'=>'4-06-01-010', 
                'title_name'=>'Miscellaneous Income', 
                'title_category_id'=>'6', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            // 	Special Education Fund (SEF)
            
            
                // Trust Fund
            [
                'title_code'=>'4-06-01-010', 
                'title_name'=>'Publication Cost', 
                'title_category_id'=>'7', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ],

            [
                'title_code'=>'4-06-01-010', 
                'title_name'=>'Other Payables', 
                'title_category_id'=>'7', 
                'created_at'=>now(), 
                'updated_at'=>now()
            ]
            
        ]);
    }
}
