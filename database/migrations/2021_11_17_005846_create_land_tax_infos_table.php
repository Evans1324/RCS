<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandTaxInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('land_tax_infos', function (Blueprint $table) {
            $table->id();
            $table->date('report_date')->nullable();
            $table->string('receipt_type');
            $table->unsignedBigInteger('user_ip')->nullable();
            $table->foreign('user_ip')->references('id')->on('access_p_c_s');
            $table->unsignedBigInteger('series_id');
            $table->foreign('series_id')->references('id')->on('serials');
            $table->integer('serial_number');
            $table->unsignedBigInteger('dr_id')->nullable();
            $table->foreign('dr_id')->references('id')->on('serial_s_g_s');
            $table->integer('dr_number')->nullable();
            
            $table->unsignedBigInteger('municipality_id')->nullable();
            $table->foreign('municipality_id')->references('id')->on('municipalities');

            $table->unsignedBigInteger('barangay_id')->nullable();
            $table->foreign('barangay_id')->references('id')->on('barangays');

            $table->unsignedBigInteger('client_type_id')->nullable();
            $table->foreign('client_type_id')->references('id')->on('customer_types');
            
            $table->string('client_type_radio')->nullable();
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_initial')->nullable();
            $table->string('business_name')->nullable();
            $table->string('owner')->nullable();
            $table->string('address')->nullable();
            $table->string('trade_name_permittees')->nullable();
            $table->string('permittee')->nullable();
            $table->string('trade_name_permit_fees')->nullable();
            $table->string('bidders_business_name')->nullable();
            $table->string('owner_representative')->nullable();
            $table->string('proprietor')->nullable();
            $table->unsignedBigInteger('lot_rental_id')->nullable();
            $table->foreign('lot_rental_id')->references('id')->on('rentals');
            $table->string('spouses')->nullable();
            $table->string('company')->nullable();
            $table->string('sex')->nullable();

            $table->string('transact_type');
            $table->string('bank_name')->nullable();
            $table->integer('number')->nullable();
            $table->string('transact_date')->nullable();
            $table->string('bank_remarks')->nullable();
            $table->string('receipt_remarks', 1000)->nullable();
            $table->string('certificate', 1000)->nullable();
            $table->string('total_amount')->nullable();
            $table->string('status')->nullable();
            $table->string('sharing_status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('land_tax_infos');
        Schema::create('land_tax_infos', function (Blueprint $table) {
            $table->softDeletes();
        });
    }
}
    