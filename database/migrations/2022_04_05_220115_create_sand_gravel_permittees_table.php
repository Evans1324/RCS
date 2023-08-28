<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSandGravelPermitteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sand_gravel_permittees', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('trade_name');
            $table->string('permittee');
            $table->string('permitted_area_municipality');
            $table->string('permitted_area_barangay');
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
        Schema::dropIfExists('sand_gravel_permittees');
        Schema::create('sand_gravel_permittees', function (Blueprint $table) {
            $table->softDeletes();
        });
    }
}
