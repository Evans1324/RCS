<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contractors;

class ContractorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contractors::truncate();

        $file = fopen(base_path("database/contractors.csv"), "r");

        $line = true;
        while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
            if (!$line) {
                Contractors::create([
                    "business_name" => $data[2],
                    "owner" => $data[3],
                    "position" => $data[4],
                    "address" => $data[5],
                    "contact_number" => $data[6],
                    "status" => $data[7],
                ]);
            }
            $line = false;
        }
        fclose($file);

    }
}
