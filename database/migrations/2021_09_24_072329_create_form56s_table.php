<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForm56sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form56s', function (Blueprint $table) {
            $table->id();
            $table->string('effectivity_year');
            $table->string('tax_precentage');
            $table->string('aid_in_full');
            $table->string('paid_in_full');
            $table->string('penalty_per_month');
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
        Schema::dropIfExists('form56s');
    }
}
