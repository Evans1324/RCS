<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RateScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rate_schedules')->insert([
            //BAC
                //BAC Drugs & Meds
            [
                'shared_label'=>'Bid Documents (Forms)',
                'col_rate_id'=>'1',
                'shared_value'=>'5000.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

                // BAC Goods & Services
            [
                'shared_label'=>'Bid Documents (Forms)',
                'col_rate_id'=>'2',
                'shared_value'=>'5000.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

                //BAC INFRA
            [
                'shared_label'=>'Bid Document Fee - Bidding',
                'col_rate_id'=>'3',
                'shared_value'=>'5000.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            // Tax Revenue
                // Real Property Transfer Tax
            [
                'shared_label'=>'Professional Tax Receipt CY 2021',
                'col_rate_id'=>'4',
                'shared_value'=>'300.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

                // Tax on Sand, Gravel & Other Quarry Prod.

            [
                'shared_label'=>'Aggregate Base Course/SBBC',
                'col_rate_id'=>'6',
                'shared_value'=>'15.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'cu.m',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>'Sand and Gravel',
                'col_rate_id'=>'6',
                'shared_value'=>'22.50',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'cu.m',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>'Boulders/stones',
                'col_rate_id'=>'6',
                'shared_value'=>'22.50',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'cu.m',	
                'created_at'=>now(),
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>'Crushed Gravel and Sand',
                'col_rate_id'=>'6',
                'shared_value'=>'27.50',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'cu.m',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>'Sand and Gravel Penalty',
                'col_rate_id'=>'6',
                'shared_value'=>'100.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'cu.m',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

                // Tax on Delivery Trucks & Vans

            [
                'shared_label'=>'Annual Fixed Tax (1 unit)',
                'col_rate_id'=>'7',
                'shared_value'=>'600.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            // Service Income
                // Permit Fees
            [
                'shared_label'=>'Permit Fee CY 2021-as Printing and Publications',
                'col_rate_id'=>'15',
                'shared_value'=>'2000.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>'Permit Fee CY 2021-Franchise Tax on Cable Antenna Networks & Radio Stns; Tel/Mob Services',
                'col_rate_id'=>'15',
                'shared_value'=>'3000.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>'Permit Fee CY 2021-Proprietors, Lessors or Operators of Amusement Places',
                'col_rate_id'=>'15',
                'shared_value'=>'2000.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>'Permit Fee CY 2021-Extraction and Processing of Sand, Gravel and Other Quarry Resources',
                'col_rate_id'=>'15',
                'shared_value'=>'1000.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>'Permit Fee CY 2021-Operators of Delivery Trucks or Vans',
                'col_rate_id'=>'15',
                'shared_value'=>'500.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>'Annual Fee CY 2021- Crusher Plant, Cement Batching Plant, and Asphalt Batching Plant',
                'col_rate_id'=>'15',
                'shared_value'=>'50000.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>'Annual Fee CY 2021- Screening Plant Provided, however, that if the Screening Plant',
                'col_rate_id'=>'15',
                'shared_value'=>'20000.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>'Annual Fee CY 2021-Power Producer/Operator of Hydro-Electric Plant',
                'col_rate_id'=>'15',
                'shared_value'=>'1000.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>'Annual Fee CY 2021-Commercial Banks, Insurance Companies or Financial Institutions',
                'col_rate_id'=>'15',
                'shared_value'=>'1000.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>'Annual Fee CY 2021-Malls/Department Stores/Supermarkets-',
                'col_rate_id'=>'15',
                'shared_value'=>'1000.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>'Annual Fee CY 2021-as Construction Services',
                'col_rate_id'=>'15',
                'shared_value'=>'1500.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>'Annual Fee CY 2021-Polyclinics,Medical/Dental/Optical Clinics',
                'col_rate_id'=>'15',
                'shared_value'=>'200.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>'Annual Fee CY 2021-Educational Institution',
                'col_rate_id'=>'15',
                'shared_value'=>'1000.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>'Annual Fee CY 2021-Recruitment Agencies/Travel & Tours',
                'col_rate_id'=>'15',
                'shared_value'=>'1000.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>'Annual Fee CY 2021-Physical Fitness Gym',
                'col_rate_id'=>'15',
                'shared_value'=>'500.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],


            [
                'shared_label'=>'Annual Fee CY 2021-Real Estate Developers',
                'col_rate_id'=>'15',
                'shared_value'=>'1000.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>'Annual Fee CY 2021-Computer Shop',
                'col_rate_id'=>'15',
                'shared_value'=>'500.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>'Annual Fee CY 2021-Dealers/Suppliers of Drugs and Medicines',
                'col_rate_id'=>'15',
                'shared_value'=>'1000.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>'Annual Fee CY 2021-Dealers/Suppliers of Medical and  Laboratory Supplies',
                'col_rate_id'=>'15',
                'shared_value'=>'1000.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>'Annual Fee CY 2021-Dealers/Suppliers of Medical and Laboratory Equipment',
                'col_rate_id'=>'15',
                'shared_value'=>'1000.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>'Annual Fee CY 2021- Hauling Fee ',
                'col_rate_id'=>'15',
                'shared_value'=>'500.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>'Annual Fee CY 2021 - Others',
                'col_rate_id'=>'15',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>'Provincial Permit Fee',
                'col_rate_id'=>'15',
                'shared_value'=>'200.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>'Provincial Permit Fee (special)',
                'col_rate_id'=>'15',
                'shared_value'=>'250.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>'Annual Fee CY 2021- as Chicken Dung Operator',
                'col_rate_id'=>'15',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>'Permit Fee CY 2021- on Delivery Truck',
                'col_rate_id'=>'15',
                'shared_value'=>'500.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>'Registration Fee - Small Scale Miners',
                'col_rate_id'=>'15',
                'shared_value'=>'500.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>'Annual Extraction Clearance Fee',
                'col_rate_id'=>'15',
                'shared_value'=>'5000.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

                // Clearance & Certification Fees
            
            [
                'shared_label'=>'Certified Photocopy of Tax Declaration',
                'col_rate_id'=>'16',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>'Certified Copy of Section Map',
                'col_rate_id'=>'16',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>'Cancellation Fee on Mortgage',
                'col_rate_id'=>'16',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>'Section Map',
                'col_rate_id'=>'16',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>'History',
                'col_rate_id'=>'16',
                'shared_value'=>'540.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>'Certification of Amortization',
                'col_rate_id'=>'16',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>'Service Fee for the Annotation/Cancellation of Mortgage',
                'col_rate_id'=>'16',
                'shared_value'=>'25.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>'For blue printing per copy',
                'col_rate_id'=>'16',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Service Fee for the Sheriff's Certificate of Sales, Final Sales Extra-judicial Foreclosure",
                'col_rate_id'=>'16',
                'shared_value'=>'25.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"For blue printing per copy with certification",
                'col_rate_id'=>'16',
                'shared_value'=>'70.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Agricultural Data and Certification",
                'col_rate_id'=>'16',
                'shared_value'=>'25.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Cancellation/Discharge of Mortgaged",
                'col_rate_id'=>'16',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Cancellation of Adverse Claim",
                'col_rate_id'=>'16',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Certification Fee of Paid Taxes",
                'col_rate_id'=>'16',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Certificate of No Record",
                'col_rate_id'=>'16',
                'shared_value'=>'30.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Annotation Fee",
                'col_rate_id'=>'16',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Tax Mapping Control Roll (TMCR)",
                'col_rate_id'=>'16',
                'shared_value'=>'30.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Certified True Copy/Photo Copy",
                'col_rate_id'=>'16',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Certified Photocopy (DV)",
                'col_rate_id'=>'16',
                'shared_value'=>'35.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Certified Photocopy: Tax Declaration, Supporting Documents etc.",
                'col_rate_id'=>'16',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Certified Photocopy of Sketch Plan",
                'col_rate_id'=>'16',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Certificate of Non-Improvement",
                'col_rate_id'=>'16',
                'shared_value'=>'30.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Certificate of Property Holdings",
                'col_rate_id'=>'16',
                'shared_value'=>'30.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"General Clearance (Local)",
                'col_rate_id'=>'16',
                'shared_value'=>'15.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"General Clearance (Abroad)",
                'col_rate_id'=>'16',
                'shared_value'=>'30.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Certification Fee (Service Record)",
                'col_rate_id'=>'16',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Certificate of Non-Encumbrance",
                'col_rate_id'=>'16',
                'shared_value'=>'30.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Certification of Loan Payments/Amortization, etc.",
                'col_rate_id'=>'16',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Certification showing the existence and non-existence of any document",
                'col_rate_id'=>'16',
                'shared_value'=>'30.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Certification of Sand and Gravel Tax Payment",
                'col_rate_id'=>'16',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Certificate of Non-Property",
                'col_rate_id'=>'16',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Certificate of Assessment",
                'col_rate_id'=>'16',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Deed of Redemption",
                'col_rate_id'=>'16',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Certification Fee",
                'col_rate_id'=>'16',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Plain Photocopy",
                'col_rate_id'=>'16',
                'shared_value'=>'10.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Certification of Loan Payments",
                'col_rate_id'=>'16',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Certificate of Landholdings",
                'col_rate_id'=>'16',
                'shared_value'=>'30.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Annotation/Discharged of Mortgaged",
                'col_rate_id'=>'16',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Certified True Copy/Photocopy",
                'col_rate_id'=>'16',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Annotation/Cancellation of Mortgaged",
                'col_rate_id'=>'16',
                'shared_value'=>'25.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Certificate of Employment",
                'col_rate_id'=>'16',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Annotation of Adverse Claim",
                'col_rate_id'=>'16',
                'shared_value'=>'5.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Certification of Tax Payment",
                'col_rate_id'=>'16',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Certificate of Tax Exemption",
                'col_rate_id'=>'16',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Certificate of Last Salary",
                'col_rate_id'=>'16',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Annotation of Court Order/Decision",
                'col_rate_id'=>'16',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Certified Photocopy Plain",
                'col_rate_id'=>'16',
                'shared_value'=>'10.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],
            [
                'shared_label'=>"Field Appraisal Application Sheet",
                'col_rate_id'=>'16',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Certified Copy of Lot Plan/s",
                'col_rate_id'=>'16',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Certificate of Full Payment",
                'col_rate_id'=>'16',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Annotation of Lis Pendens",
                'col_rate_id'=>'16',
                'shared_value'=>'25.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Cancellation of Levy",
                'col_rate_id'=>'16',
                'shared_value'=>'25.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            // [
            //     'shared_label'=>"Certificate (BTS)",
            //     'col_rate_id'=>'13',
            //     'shared_value'=>'50.00',	
            //     'shared_per_unit'=>'1',	
            //     'shared_unit'=>'1',	
            //     'created_at'=>now(),	
            //     'updated_at'=>now()	
            // ],

            // [
            //     'shared_label'=>"Transcript (BTS)",
            //     'col_rate_id'=>'13',
            //     'shared_value'=>'50.00',	
            //     'shared_per_unit'=>'1',	
            //     'shared_unit'=>'1',	
            //     'created_at'=>now(),	
            //     'updated_at'=>now()	
            // ],

            // Supervision and Regulation, Enforcement Fees (Quarantine Fees)

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped In Bee/s (Queen)",
                'col_rate_id'=>'17',
                'shared_value'=>'7.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'Queen',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped In Bee Products Honey",
                'col_rate_id'=>'17',
                'shared_value'=>'5.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'liter',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped Out Cattle, Carabao, Horse",
                'col_rate_id'=>'17',
                'shared_value'=>'17.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped Out Swine: Category A (61 kgs-80 kgs)",
                'col_rate_id'=>'17',
                'shared_value'=>'17.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped Out Swine: Category B (81 kgs-199 kgs)",
                'col_rate_id'=>'17',
                'shared_value'=>'20.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped Out Swine (Grower: 30-60 kgs5)",
                'col_rate_id'=>'17',
                'shared_value'=>'10.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped Out Swine (Weanlings: 16-29 kgs)",
                'col_rate_id'=>'17',
                'shared_value'=>'5.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped Out Piglets ( 10-17 kgs ) ",
                'col_rate_id'=>'17',
                'shared_value'=>'3.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped Out Goat, Sheep, Cat, Dog",
                'col_rate_id'=>'17',
                'shared_value'=>'5.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal  Quarantine Regulatory Fee - Shipped Out Poultry Eggs case/30doz/360pcs",
                'col_rate_id'=>'17',
                'shared_value'=>'3.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'case',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal  Quarantine Regulatory Fee - Shipped Out Poultry Eggs crate/35doz/420pcs",
                'col_rate_id'=>'17',
                'shared_value'=>'3.50',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'crate',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped Out Pullets (Ready to lay)",
                'col_rate_id'=>'17',
                'shared_value'=>'0.17',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped Out Culled Layers",
                'col_rate_id'=>'17',
                'shared_value'=>'0.10',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped Out Breeder Cull",
                'col_rate_id'=>'17',
                'shared_value'=>'0.10',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped Out Assorted Meat Products and Meat by- products ",
                'col_rate_id'=>'17',
                'shared_value'=>'0.17',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped Out Duck, Native Chicken, Quail, Turkey",
                'col_rate_id'=>'17',
                'shared_value'=>'0.17',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped Out Assorted Meat Products and Meat by - products",
                'col_rate_id'=>'17',
                'shared_value'=>'0.17',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped Out Bee/s (Colony)",
                'col_rate_id'=>'17',
                'shared_value'=>'10.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'colony',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped Out Bee/s (Queen)",
                'col_rate_id'=>'17',
                'shared_value'=>'5.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'queen',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped Out Bee Products Honey",
                'col_rate_id'=>'17',
                'shared_value'=>'2.50',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'liter',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fees",
                'col_rate_id'=>'17',
                'shared_value'=>'0.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal  Quarantine Regulatory Fee - Shipped In Poultry Eggs crate/35doz/420pcs",
                'col_rate_id'=>'17',
                'shared_value'=>'.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'Crate',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped In Raw Chicken Dung/Manure",
                'col_rate_id'=>'17',
                'shared_value'=>'0.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'Sack/sack',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee -Shipped In Assorted Chicken Products",
                'col_rate_id'=>'17',
                'shared_value'=>'0.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'kgs.',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Swine: Category A(61 kgs-80 kgs)",
                'col_rate_id'=>'17',
                'shared_value'=>'0.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'Head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped In Goat",
                'col_rate_id'=>'17',
                'shared_value'=>'10.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'Head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped In Sheep",
                'col_rate_id'=>'17',
                'shared_value'=>'10.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'Head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],


            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped In Cattle",
                'col_rate_id'=>'17',
                'shared_value'=>'25.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'Head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped In Carabao",
                'col_rate_id'=>'17',
                'shared_value'=>'25.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'Head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped In Horse",
                'col_rate_id'=>'17',
                'shared_value'=>'25.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'Head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped In Bangus",
                'col_rate_id'=>'17',
                'shared_value'=>'0.15',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'kgs.',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee -  Shipped In Tilapia",
                'col_rate_id'=>'17',
                'shared_value'=>'0.15',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'kgs.',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee -  Shipped In Shrimp",
                'col_rate_id'=>'17',
                'shared_value'=>'0.15',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'kgs.',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped In Other Marine Fishes/Species",
                'col_rate_id'=>'17',
                'shared_value'=>'0.15',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'kgs.',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],
            
            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Fighting Cock",
                'col_rate_id'=>'17',
                'shared_value'=>'200.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'Head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped In Assorted Meat Products and Meat by- products ",
                'col_rate_id'=>'17',
                'shared_value'=>'0.10',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'kgs.',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped In Goat, Sheep, cat, Dog",
                'col_rate_id'=>'17',
                'shared_value'=>'6.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'Head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Processed Chicken Manure (PCM)",
                'col_rate_id'=>'17',
                'shared_value'=>'30.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'sack',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal  Quarantine Regulatory Fee - Shipped In Poultry Eggs case/30doz/360pcs",
                'col_rate_id'=>'17',
                'shared_value'=>'6.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'case',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped In Swine: Category B (81 kgs-199 kgs)",
                'col_rate_id'=>'17',
                'shared_value'=>'30.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped In Swine: Grower (30 kgs-60 kgs)",
                'col_rate_id'=>'17',
                'shared_value'=>'20.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped In Swine: Weanlings (16 kgs-29 kgs)",
                'col_rate_id'=>'17',
                'shared_value'=>'10.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped In Piglets (10 kgs-15 kgs)",
                'col_rate_id'=>'17',
                'shared_value'=>'7.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped In Hog (200 kgs and above)",
                'col_rate_id'=>'17',
                'shared_value'=>'120.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped In Day - old Chick  ",
                'col_rate_id'=>'17',
                'shared_value'=>'0.35',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped In Pullets (Ready to lay)",
                'col_rate_id'=>'17',
                'shared_value'=>'0.35',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped In Culled Layers",
                'col_rate_id'=>'17',
                'shared_value'=>'0.15',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped In Breeder Cull",
                'col_rate_id'=>'17',
                'shared_value'=>'0.15',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped In Broiler",
                'col_rate_id'=>'17',
                'shared_value'=>'0.35',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped In Duck, Native Chicken, Quail, Turkey",
                'col_rate_id'=>'17',
                'shared_value'=>'0.35',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped In Bee/s (Colony)",
                'col_rate_id'=>'17',
                'shared_value'=>'15.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'colony',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped In Bee/s (Queen)",
                'col_rate_id'=>'17',
                'shared_value'=>'7.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'Queen',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped In Bee Products Honey",
                'col_rate_id'=>'17',
                'shared_value'=>'5.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'liter',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped Out Cattle, Carabao, Horse",
                'col_rate_id'=>'17',
                'shared_value'=>'15.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped Out Swine: Category A (61 kgs-80 kgs)",
                'col_rate_id'=>'17',
                'shared_value'=>'15.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped Out Swine: Category B (81 kgs-199 kgs)",
                'col_rate_id'=>'17',
                'shared_value'=>'20.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped Out Swine (Grower: 30-60 kgs)",
                'col_rate_id'=>'17',
                'shared_value'=>'10.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped Out Swine (Weanlings: 16-29 kgs)",
                'col_rate_id'=>'17',
                'shared_value'=>'5.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped Out Piglets ( 10-15 kgs )",
                'col_rate_id'=>'17',
                'shared_value'=>'3.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped Out Goat, Sheep, Cat, Dog",
                'col_rate_id'=>'17',
                'shared_value'=>'5.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal  Quarantine Regulatory Fee - Shipped Out Poultry Eggs case/30doz/360pcs",
                'col_rate_id'=>'17',
                'shared_value'=>'3.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'case',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal  Quarantine Regulatory Fee - Shipped Out Poultry Eggs crate/35doz/420pcs",
                'col_rate_id'=>'17',
                'shared_value'=>'3.50',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'crate',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped Out Pullets (Ready to lay)",
                'col_rate_id'=>'17',
                'shared_value'=>'0.15',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped Out Culled Layers",
                'col_rate_id'=>'17',
                'shared_value'=>'0.15',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped Out Breeder Cull",
                'col_rate_id'=>'17',
                'shared_value'=>'0.10',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped Out Broiler",
                'col_rate_id'=>'17',
                'shared_value'=>'0.15',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped Out Duck, Native Chicken, Quail, Turkey",
                'col_rate_id'=>'17',
                'shared_value'=>'0.15',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped Out Assorted Meat Products and Meat by- products",
                'col_rate_id'=>'17',
                'shared_value'=>'0.15',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'head',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped Out Bee/s (Colony)",
                'col_rate_id'=>'17',
                'shared_value'=>'0.15',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'colony',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped Out Bee/s (Queen)",
                'col_rate_id'=>'17',
                'shared_value'=>'0.15',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'queen',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fee - Shipped Out Bee Products Honey",
                'col_rate_id'=>'17',
                'shared_value'=>'0.15',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'liter',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Animal Quarantine Regulatory Fees",
                'col_rate_id'=>'17',
                'shared_value'=>'0.15',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            //     // Verification & Auth. Fees

            [
                'shared_label'=>"Verification Fee",
                'col_rate_id'=>'18',
                'shared_value'=>'20.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Verification Fee",
                'col_rate_id'=>'18',
                'shared_value'=>'500.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

                // Fines & Penalties - Service Income (NO SCHEDULE)

                // General (Buildings / Lots / Lights & Water)
            [
                'shared_label'=>"Rental: Ben Palispis Hall",
                'col_rate_id'=>'20',
                'shared_value'=>'1600.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Rental: Open Gymnasium",
                'col_rate_id'=>'20',
                'shared_value'=>'1000.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'first 8 hrs',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Lot Rental",
                'col_rate_id'=>'20',
                'shared_value'=>'3660.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'month',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Rental: Closed Gym",
                'col_rate_id'=>'20',
                'shared_value'=>'1000.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'hour',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Rental: Solibao/Gongs",
                'col_rate_id'=>'20',
                'shared_value'=>'1000.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,		
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Rental: Ethnic dancing blankets(3 pcs.)",
                'col_rate_id'=>'20',
                'shared_value'=>'250.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,		
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Rental: Devit",
                'col_rate_id'=>'20',
                'shared_value'=>'100.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Rental: G-string",
                'col_rate_id'=>'20',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,		
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Rental: Vest/Chaleco",
                'col_rate_id'=>'20',
                'shared_value'=>'100.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,		
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Rental: Head dress",
                'col_rate_id'=>'20',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,		
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Rental: Kayabang",
                'col_rate_id'=>'20',
                'shared_value'=>'20.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,		
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Rental: Steel chairs",
                'col_rate_id'=>'20',
                'shared_value'=>'2.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,		
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Rental: Parachute",
                'col_rate_id'=>'20',
                'shared_value'=>'500.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,		
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Rental: Grandstand with Oval (day time)",
                'col_rate_id'=>'20',
                'shared_value'=>'500.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,		
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Rental: Grandstand with Oval (night time)",
                'col_rate_id'=>'20',
                'shared_value'=>'700.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,		
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Rental: Sound System",
                'col_rate_id'=>'20',
                'shared_value'=>'400.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,		
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Lot Rental",
                'col_rate_id'=>'20',
                'shared_value'=>'1966.25',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,		
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Lot Rental",
                'col_rate_id'=>'20',
                'shared_value'=>'2147.75',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,		
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Lot Rental",
                'col_rate_id'=>'20',
                'shared_value'=>'3327.50',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,		
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Rental Fee (120 sqm portion PHO)",
                'col_rate_id'=>'20',
                'shared_value'=>'60000.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,		
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Rental: Covered Court",
                'col_rate_id'=>'20',
                'shared_value'=>'100.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,		
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            // Benguet Cold Chain Operation
            [
                'shared_label'=>"Truck Rentals",
                'col_rate_id'=>'21',
                'shared_value'=>'5000.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Cold Storage Rentals",
                'col_rate_id'=>'21',
                'shared_value'=>'350.00',	
                'shared_per_unit'=>'0',
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Crates Rental",
                'col_rate_id'=>'21',
                'shared_value'=>'100.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            // Sales on Agricultural Products (BPENRO)

            [
                'shared_label'=>"Commercial purposes",
                'col_rate_id'=>'22',
                'shared_value'=>'2.00',	
                'shared_per_unit'=>'1',
                'shared_unit'=>'sq.m',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Residential purposes",
                'col_rate_id'=>'22',
                'shared_value'=>'1.50',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'sq.m',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            // Sale on Delivery Receipts / Books / Appl. Fees

            [
                'shared_label'=>"Delivery Receipt (Industrial)",
                'col_rate_id'=>'23',
                'shared_value'=>'130.00',	
                'shared_per_unit'=>'1',
                'shared_unit'=>'pad',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Delivery Receipt (Commercial)",
                'col_rate_id'=>'23',
                'shared_value'=>'130.00',
                'shared_per_unit'=>'1',
                'shared_unit'=>'pad',
                'created_at'=>now(),
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Forms",
                'col_rate_id'=>'23',
                'shared_value'=>'30.00',
                'shared_per_unit'=>'0',
                'shared_unit'=>null,
                'created_at'=>now(),
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Processing Fee",
                'col_rate_id'=>'23',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Application Fee",
                'col_rate_id'=>'23',
                'shared_value'=>'300.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Filing Fee",
                'col_rate_id'=>'23',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Registration of Small Scale Miners",
                'col_rate_id'=>'23',
                'shared_value'=>'500.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Book (Treasury of Beliefs and Home Rituals)",
                'col_rate_id'=>'23',
                'shared_value'=>'100.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'Book',	
                'created_at'=>now(),	
                'updated_at'=>now()
            ],

            // Sales on Veterinary Products
            [
                'shared_label'=>"Biological Asset",
                'col_rate_id'=>'24',
                'shared_value'=>'0.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Veterinary Drugs/Medicines/Vaccine",
                'col_rate_id'=>'24',
                'shared_value'=>'0.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Agricultural Produce (Egg, meat, honey, boar semen)",
                'col_rate_id'=>'24',
                'shared_value'=>'0.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Medical Fee (wound repair, VSP, AI, Castration, Spay, etc.)",
                'col_rate_id'=>'24',
                'shared_value'=>'0.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Other Supplies (Syringes, catgut, squeeze bottle, catheter, vac'n cards, etc.)",
                'col_rate_id'=>'24',
                'shared_value'=>'0.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Inspcetion Fee",
                'col_rate_id'=>'24',
                'shared_value'=>'0.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            // Miscellaneous Income
            [
                'shared_label'=>"ID Fee (BTS)",
                'col_rate_id'=>'24',
                'shared_value'=>'100.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            // School Fees
            [
                'shared_label'=>"Tuition Fee Automotive Servicing NC I",
                'col_rate_id'=>'25',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Tuition Fee Bread and Pastry Production NC II",
                'col_rate_id'=>'25',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Tuition Fee Hairdressing NC II",
                'col_rate_id'=>'25',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Tuition Fee Tailoring NC II",
                'col_rate_id'=>'25',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Tuition Fee Beauty Care NC II",
                'col_rate_id'=>'25',
                'shared_value'=>'50.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            [
                'shared_label'=>"Training Fees",
                'col_rate_id'=>'25',
                'shared_value'=>'100.00',	
                'shared_per_unit'=>'0',	
                'shared_unit'=>null,	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],

            // Miscellaneous Income
            [
                'shared_label'=>"ID Fee",
                'col_rate_id'=>'27',
                'shared_value'=>'100.00',	
                'shared_per_unit'=>'1',	
                'shared_unit'=>'1',	
                'created_at'=>now(),	
                'updated_at'=>now()	
            ],
        ]);
    }
}
