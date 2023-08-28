<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_cases', function (Blueprint $table) {
            $table->id();
            $table->string('source_barangay');
            $table->integer('source_percentage');
            $table->string('barangay_sharing');
            $table->integer('percentage_sharing');
            $table->string('remarks');
            $table->Date('effectivity_date')->nullable();
            $table->Date('effectivity_end_date')->nullable();
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
        Schema::dropIfExists('special_cases');
        Schema::create('special_cases', function (Blueprint $table) {
            $table->softDeletes();
        });
    }
}
