<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Admin Admin',
                'email' => 'admin@black.com',
                'email_verified_at' => now(),
                'password' => Hash::make('secret'),
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'id' => 2,
                'name' => 'Admin 1',
                'email' => 'admin1@revenue.com',
                'email_verified_at' => now(),
                'password' => Hash::make('admin1'),
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'id' => 3,
                'name' => 'Admin 2',
                'email' => 'admin2',
                'email_verified_at' => now(),
                'password' => Hash::make('admin2'),
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'id' => 4,
                'name' => 'PC UNIT 1',
                'username' => 'pcunit1@revenue.com',
                'email_verified_at' => now(),
                'password' => Hash::make('unit1'),
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'id' => 5,
                'name' => 'PC UNIT 2',
                'email' => 'pcunit2',
                'email_verified_at' => now(),
                'password' => Hash::make('unit2'),
                'created_at' => now(),
                'updated_at' => now()
            ],

            
            [
                'id' => 6,
                'name' => 'PC UNIT 3',
                'email' => 'pcunit3',
                'email_verified_at' => now(),
                'password' => Hash::make('unit3'),
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'id' => 7,
                'name' => 'PC UNIT 4',
                'email' => 'pcunit4',
                'email_verified_at' => now(),
                'password' => Hash::make('unit4'),
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'id' => 8,
                'name' => 'PC UNIT 5',
                'email' => 'pcunit5',
                'email_verified_at' => now(),
                'password' => Hash::make('unit5'),
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'id' => 9,
                'name' => 'PC UNIT 6',
                'email' => 'pcunit6',
                'email_verified_at' => now(),
                'password' => Hash::make('unit6'),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
