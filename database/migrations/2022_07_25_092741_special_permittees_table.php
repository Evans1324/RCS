<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpecialPermitteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_permitees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('special_case_id');
            $table->foreign('special_case_id')->references('id')->on('special_cases');
            $table->unsignedBigInteger('permitee_id');
            $table->foreign('permitee_id')->references('id')->on('sand_gravel_permittees');
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
        //
    }
}
