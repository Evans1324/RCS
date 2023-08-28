<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rentals;

class RentalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rentals::truncate();

        $file = fopen(base_path("database/rentals.csv"), "r");

        $line = true;
        while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
            if (!$line) {
                Rentals::create([
                    "name" => $data[0],
                    "location" => $data[1],
                    "lease_of_contact" => $data[2]
                ]);
            }
            $line = false;
        }
        fclose($file);
    }
}
