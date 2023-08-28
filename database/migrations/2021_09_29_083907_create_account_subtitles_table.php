<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountSubtitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_subtitles', function (Blueprint $table) {
            $table->id();
            // $table->string('title');
            $table->unsignedBigInteger('title_id');
            $table->foreign('title_id')->references('id')->on('account_titles');
            $table->string('subtitle');
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
        Schema::dropIfExists('account_subtitles');
        Schema::create('account_subtitles', function (Blueprint $table) {
            $table->softDeletes();
        });
    }
}
