<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSerialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serials', function (Blueprint $table) {
            $table->id();
            $table->integer('start_serial');
            $table->integer('end_serial');
            $table->string('form');
            $table->string('unit')->nullable();
            
            $table->unsignedBigInteger('fund_id')->nullable();
            $table->foreign('fund_id')->references('id')->on('posts');
            $table->unsignedBigInteger('mun_id')->nullable();
            $table->foreign('mun_id')->references('id')->on('municipalities');
            $table->unsignedBigInteger('acc_officer_id')->nullable();
            $table->foreign('acc_officer_id')->references('id')->on('accountable_officers');
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
        Schema::dropIfExists('serials');
        Schema::create('serials', function (Blueprint $table) {
            $table->softDeletes();
        });
    }
}
