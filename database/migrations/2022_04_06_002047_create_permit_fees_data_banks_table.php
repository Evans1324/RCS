<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermitFeesDataBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permit_fees_data_banks', function (Blueprint $table) {
            $table->id();
            $table->string('account_type');
            $table->string('trade_name');
            $table->string('proprietor');
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
        Schema::dropIfExists('permit_fees_data_banks');
        Schema::create('permit_fees_data_banks', function (Blueprint $table) {
            $table->softDeletes();
        });
    }
}
