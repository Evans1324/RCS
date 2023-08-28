<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rate_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('col_rate_id');
            $table->foreign('col_rate_id')->references('id')->on('collection_rates');

            $table->string('shared_label')->nullable();
            $table->decimal('shared_value')->nullable();
            $table->integer('shared_per_unit')->nullable();
            $table->string('shared_unit')->nullable();
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
        Schema::dropIfExists('rate_schedules');
    }
}
