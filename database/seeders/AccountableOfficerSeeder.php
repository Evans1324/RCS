<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountableOfficerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accountable_officers')->insert([
            ['officers'=>'IMELDA I. MACANES',	
            'created_at'=>now(),	
            'updated_at'=>now()
        ],

        ['officers'=>'JULIE V. ESTEBAN',	
            'created_at'=>now(),	
            'updated_at'=>now()
        ],

        ['officers'=>'IRENE C. BAGKING',	
            'created_at'=>now(),	
            'updated_at'=>now()
        ],

        ['officers'=>'MARY JANE P. LAMPACAN',	
            'created_at'=>now(),	
            'updated_at'=>now()
        ],

        ['officers'=>'LORENZA C. LAMSIS',	
            'created_at'=>now(),	
            'updated_at'=>now()
        ],

        ['officers'=>'JOANA G. COLSIM',	
            'created_at'=>now(),	
            'updated_at'=>now()
        ],

        ['officers'=>'MELCHOR I. DICLAS, MD',	
            'created_at'=>now(),	
            'updated_at'=>now()
        ],

        ['officers'=>'PURITA LESING',	
            'created_at'=>now(),	
            'updated_at'=>now()
        ]
        ]);
    }
}
