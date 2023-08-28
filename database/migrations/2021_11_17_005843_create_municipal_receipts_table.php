<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMunicipalReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municipal_receipts', function (Blueprint $table) {
            $table->id();
            $table->date('mun_receipt_date');
            $table->integer('mun_receipt_no');

            $table->unsignedBigInteger('mun_client_type_id')->nullable();
            $table->foreign('mun_client_type_id')->references('id')->on('customer_types');

            $table->unsignedBigInteger('mun_municipality_id')->nullable();
            $table->foreign('mun_municipality_id')->references('id')->on('municipalities');

            $table->unsignedBigInteger('mun_barangay_id')->nullable();
            $table->foreign('mun_barangay_id')->references('id')->on('barangays');
            
            $table->string('mun_client_type_radio')->nullable();
            $table->string('mun_last_name')->nullable();
            $table->string('mun_first_name')->nullable();
            $table->string('mun_middle_initial')->nullable();
            $table->string('mun_business_name')->nullable();
            $table->string('mun_owner')->nullable();
            $table->string('mun_address')->nullable();
            $table->string('mun_trade_name_permittees')->nullable();
            $table->string('mun_permittee')->nullable();
            $table->string('mun_trade_name_permit_fees')->nullable();
            $table->string('mun_proprietor')->nullable();
            $table->string('mun_bidders_business_name')->nullable();
            $table->string('mun_owner_representative')->nullable();
            $table->string('mun_spouses')->nullable();
            $table->string('mun_company')->nullable();
            $table->string('mun_sex')->nullable();

            $table->string('mun_transact_type');
            $table->string('mun_bank_name')->nullable();
            $table->integer('mun_number')->nullable();
            $table->string('mun_transact_date')->nullable();
            $table->string('mun_bank_remarks')->nullable();
            $table->string('mun_receipt_remarks', 1000)->nullable();
            $table->string('mun_certificate', 1000)->nullable();
            $table->string('mun_total_amount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('municipal_receipts');
    }
}
