<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessPCSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_p_c_s', function (Blueprint $table) {
            $table->id();
            $table->string('pc_name');
            $table->string('assigned_ip');
            $table->string('process_type');
            $table->string('process_form');
            $table->unsignedBigInteger('serial_id');
            $table->foreign('serial_id')->references('id')->on('serials');
            $table->string('assigned_status');
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
        Schema::dropIfExists('access_p_c_s');
        Schema::create('access_p_c_s', function (Blueprint $table) {
            $table->softDeletes();
        });
    }
}
