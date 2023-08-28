<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBudgetEstimatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_estimates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('title_id');
            // $table->unsignedBigInteger('subtitle_id');
            $table->foreign('category_id')->references('id')->on('posts');
            $table->foreign('group_id')->references('id')->on('account_groups');
            $table->foreign('title_id')->references('id')->on('account_titles');
            // $table->foreign('subtitle_id')->references('id')->on('account_groups');
            $table->integer('year');
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
        Schema::dropIfExists('budget_estimates');
    }
}
