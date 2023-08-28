<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_rates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('acc_titles_id')->nullable();
            $table->unsignedBigInteger('acc_subtitles_id')->nullable();
            $table->unsignedBigInteger('rate_change_id')->nullable();

            $table->foreign('acc_titles_id')->references('id')->on('account_titles');
            $table->foreign('acc_subtitles_id')->references('id')->on('account_subtitles');
            $table->foreign('rate_change_id')->references('id')->on('rate_changes');
            $table->integer('shared_status')->nullable();
            $table->decimal('provincial_share')->nullable();
            $table->decimal('municipal_share')->nullable();
            $table->decimal('barangay_share')->nullable();
            $table->string('rate_type')->nullable();
            $table->decimal('fixed_rate')->nullable();
            $table->decimal('percent_value')->nullable();
            $table->string('percent_of')->nullable();
            $table->integer('deadline_status')->nullable();
            $table->decimal('rate_after_deadline')->nullable();
            $table->string('deadline_date')->nullable();
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
        Schema::dropIfExists('collection_rates');
    }
}