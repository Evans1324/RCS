<?php
namespace Database\Seeders;

use App\Http\Controllers\CollectionRatesController;
use App\Models\AccountableOfficers;
use App\Models\CustomerType;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks = 0");
        $this->call([UsersTableSeeder::class]);
        $this->call([AccountCategoriesSeeder::class]);
        $this->call([AccountGroupsSeeder::class]);
        $this->call([AccountTitlesSeeder::class]);
        $this->call([AccountSubtitlesSeeder::class]);
        $this->call([RateChangeSeeder::class]);
        $this->call([CollectionRatesSeeder::class]);
        $this->call([RateScheduleSeeder::class]);
        $this->call([Form56Seeder::class]);
        $this->call([MunicipalitySeeder::class]);
        $this->call([BarangaySeeder::class]);
        $this->call([CustomerTypeSeeder::class]);
        $this->call([AccountableOfficerSeeder::class]);
        $this->call([SerialSeeder::class]);
        $this->call([AccessPCSeeder::class]);
        $this->call([ContractorsSeeder::class]);
        $this->call([OfficersSeeder ::class]);
        $this->call([PositionsSeeder ::class]);
        $this->call([DepartmentsSeeder ::class]);
        $this->call([CertOfficersSeeder::class]);
        $this->call([PermitFeesDataBankSeeder::class]); 
        $this->call([PermitteesDataBankSeeder::class]);
        $this->call([BiddersSeeder::class]);
        $this->call([RentalsSeeder::class]);
        $this->call([CutOffSeeder::class]);
        $this->call([SpecialCaseSeeder::class]);
    }
}
