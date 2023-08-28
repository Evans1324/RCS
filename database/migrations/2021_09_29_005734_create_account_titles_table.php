<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_titles', function (Blueprint $table) {
            $table->id();
            $table->string('title_code')->nullable();
            $table->string('title_name');
            $table->unsignedBigInteger('title_category_id');
            $table->foreign('title_category_id')->references('id')->on('account_groups');
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
        Schema::dropIfExists('account_titles');
        Schema::create('account_titles', function (Blueprint $table) {
            $table->softDeletes();
        });
    }
}
