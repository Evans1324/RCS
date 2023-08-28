<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customer_types')->insert([
            ['description_type'=>'Monitoring', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>"Provincial Projects (Prov'l Contractors)", 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'National Projects (DWPH-CAR/National Projects)', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Brgy. Remittance', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Municipal Remittance', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Industrial', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Commercial', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Individual/Company', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Lot Rental', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Franchise Tax', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Printing & Publication', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Supplier of Drugs & Meds', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Bidders', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Extraction of Sand, Gravel, and Other Quarrying Materials (Sand and Gravel Permittees)', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Professional Tax', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'General (Buildings / Lots / Lights & Water)', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Dealers/Suppliers of Drugs & Medicines/Pharmacy', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Dealers/Suppliers of Medical & Laboratoy Supplies', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Dealers/Suppliers of Medical & Laboratoy Equipment', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Dealers/Suppliers of Medical Supplies', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Dealers/Suppliers of Laboratory Supplies', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Dealers/Suppliers of Medical Equipment', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Dealers/Suppliers of Laboratory Equipment', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Small Scale Mining', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'General Merchandise', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Mining Tax', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'On Business enjoying a franchise: Cable Antenna Networks and Radio Stations; Telephone/Mobile Services and such other similir business', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Copmuter Center, Internet Cafe, Computer Job & Printing', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Polyclinics Mdeical/Dental/Optical Clinics', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Private Educational Institution', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Power Producer/Operator of Hydro-Electric Plant including Mini-Hydro Electric Plant', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Commercial Banks, Insurance Companies and Other Financial Institutions', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Malls/Department Stores/Supermarkets', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Food Franchises (Large Scale)/Restaurant', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Vocational/Driving School/Music/Dancing', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Recruitment Agencies/Travel & Tours', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Physical Fitness Gym', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Real Estate Developers', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Other Business participating in Procurement Biddings', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Proprietors, Lessors, or Operators of Amusement Places', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Annual Fixed Tax', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Crusher Plant, Cement Batching Plant, and Asphalt Batching Plant', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Chicken Dung Dealers', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Vegetables Dealers', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Pakyaw Contractors', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Cash Division Transactions', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Amusement Tax', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Benguet Technical School', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Animal Quarantine Regulatory Fees', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Bureau of Treasury', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Benguet Cold Chain', 'created_at'=>now(), 'updated_at'=>now()],
            ['description_type'=>'Sales of Veterinary Products', 'created_at'=>now(), 'updated_at'=>now()]
        ]);
    }
}
