<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangays', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mun_id');
            $table->foreign('mun_id')->references('id')->on('municipalities');

            $table->string('barangay_name');
            // $table->string('atok')->nullable();
            // $table->string('bakun')->nullable();
            // $table->string('bokod')->nullable();
            // $table->string('buguias')->nullable();
            // $table->string('itogon')->nullable();
            // $table->string('kabayan')->nullable();
            // $table->string('kapangan')->nullable();
            // $table->string('kibungan')->nullable();
            // $table->string('la_trinidad')->nullable();
            // $table->string('mankayan')->nullable();
            // $table->string('sablan')->nullable();
            // $table->string('tuba')->nullable();
            // $table->string('tublay')->nullable();
            // $table->string('other')->nullable();
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
        Schema::dropIfExists('barangays');
    }
}
