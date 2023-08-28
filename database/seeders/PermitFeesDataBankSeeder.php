<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermitFeesDataBankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permit_fees_data_banks')->insert([
            //Transfer Tax; Permit Fees
            [
                'account_type'=>'Franchise Tax',
                'trade_name'=>'CONVERGE INFORMATION COMMUNICATIONS TECHNOLOGY SOLUTIONS, INC.',
                'proprietor'=>null,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'account_type'=>'Franchise Tax',
                'trade_name'=>'DIGITEL MOBILE PHIL., INC.',
                'proprietor'=>null,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'account_type'=>'Franchise Tax',
                'trade_name'=>'GLOBE TELECOMMUNICATIONS, INC.',
                'proprietor'=>null,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'account_type'=>'Franchise Tax',
                'trade_name'=>'INNOVE COMMUNICATIONS, INC.',
                'proprietor'=>null,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'account_type'=>'Franchise Tax',
                'trade_name'=>'MOUNTAIN VIEW SATELLITE CORPORATION',
                'proprietor'=>null,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'account_type'=>'Franchise Tax',
                'trade_name'=>'PHILIPPINE LONG DISTANCE TELEPHONE (PLDT)',
                'proprietor'=>null,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'account_type'=>'Franchise Tax',
                'trade_name'=>'PILIPINO CABLE CORP. (SKYCABLE).',
                'proprietor'=>null,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'account_type'=>'Franchise Tax',
                'trade_name'=>'SMART COMMUNICATIONS, INC.',
                'proprietor'=>null,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            // Printing and Publication Tax; Permit Fees
            [
                'account_type'=>'Printing and Publication Tax',
                'trade_name'=>'SMART COMMUNICATIONS, INC.',
                'proprietor'=>null,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'account_type'=>'Printing and Publication Tax',
                'trade_name'=>'BAGUIO CHRONICLE MEDIA INC.',
                'proprietor'=>null,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'account_type'=>'Printing and Publication Tax',
                'trade_name'=>'GOCHAMAYTA PRINT SHOP.',
                'proprietor'=>'TANGIB, HAJI G.',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'account_type'=>'Printing and Publication Tax',
                'trade_name'=>'ICS PRINTING PRESS',
                'proprietor'=>'OCDEN, ANGELA P.',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'account_type'=>'Printing and Publication Tax',
                'trade_name'=>'RIGHT MARK PRINTING PRESS',
                'proprietor'=>'ELADJOE, JIM RYAN T.',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'account_type'=>'Printing and Publication Tax',
                'trade_name'=>'MS PRINTING PRESS AND COPY CENTER',
                'proprietor'=>'CAMHIT, STANLEY A.',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'account_type'=>'Printing and Publication Tax',
                'trade_name'=>'PERLAS NG PILIPINAS',
                'proprietor'=>'LOPEZ, MARITES B.',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
        ]);
    }
}
