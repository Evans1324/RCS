<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvinvialPermitArraysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provincial_permit_arrays', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prov_cert_id')->nullable();
            $table->foreign('prov_cert_id')->references('id')->on('certifications');
            $table->string('prov_feecharge')->nullable();
            $table->integer('prov_amount')->nullable();
            $table->integer('prov_ornumber')->nullable();
            $table->string('prov_date')->nullable();
            $table->string('prov_initials')->nullable();
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
        Schema::dropIfExists('provincial_permit_arrays');
        Schema::create('provincial_permit_arrays', function (Blueprint $table) {
            $table->softDeletes();
        });
    }
}
