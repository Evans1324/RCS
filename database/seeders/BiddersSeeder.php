<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bidders;

class BiddersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bidders::truncate();

        $file = fopen(base_path("database/bidders.csv"), "r");

        $line = true;
        while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
            if (!$line) {
                Bidders::create([
                    "business_name" => $data[0],
                    "owner_representative" => $data[1],
                ]);
            }
            $line = false;
        }
        fclose($file);
    }
}
