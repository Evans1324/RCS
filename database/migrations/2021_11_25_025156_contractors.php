<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Contractors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contractors', function (Blueprint $table) {
            $table->id();
            // $table->integer('contractor_id')->nullable();
            $table->string('business_name')->nullable();
            $table->string('owner')->nullable();
            $table->string('position')->nullable();
            $table->string('address')->nullable();
            $table->string('contact_number')->nullable();
            $table->enum('status', ['Active', 'Passive']);
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
        Schema::dropIfExists('contractors');
    }
}
