<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandTaxAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('land_tax_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('info_id')->nullable();
            $table->foreign('info_id')->references('id')->on('land_tax_infos');
            $table->unsignedBigInteger('mun_receipts_id')->nullable();
            $table->foreign('mun_receipts_id')->references('id')->on('municipal_receipts');
            $table->string('rate_type')->nullable();
            $table->unsignedBigInteger('acc_category_id');
            $table->foreign('acc_category_id')->references('id')->on('posts');
            $table->unsignedBigInteger('acc_title_id');
            $table->foreign('acc_title_id')->references('id')->on('account_titles');
            $table->unsignedBigInteger('sub_title_id')->nullable();
            $table->foreign('sub_title_id')->references('id')->on('account_subtitles');
            $table->decimal('quantity')->nullable();
            $table->string('account');
            $table->string('nature');
            $table->decimal('amount', 10, 2);
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
        Schema::dropIfExists('land_tax_accounts');
    }
}
