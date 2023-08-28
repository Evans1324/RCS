<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSerialSGSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serial_s_g_s', function (Blueprint $table) {
            $table->id();
            $table->integer('start_serial_sg');
            $table->integer('booklets');
            $table->integer('end_serial_sg');
            $table->string('serial_sg_type');
            $table->string('status')->default('Active');
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
        Schema::dropIfExists('serial_s_g_s');
        Schema::create('serial_s_g_s', function (Blueprint $table) {
            $table->softDeletes();
        });
    }
}
