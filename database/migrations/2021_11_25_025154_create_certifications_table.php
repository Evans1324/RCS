<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('land_tax_info_id');
            $table->foreign('land_tax_info_id')->references('id')->on('land_tax_infos');
            $table->string('cert_type');
            $table->string('cert_date');
            $table->unsignedBigInteger('cert_prepared_by')->nullable();
            $table->foreign('cert_prepared_by')->references('id')->on('cert_officers');
            $table->unsignedBigInteger('cert_signee')->nullable();
            $table->foreign('cert_signee')->references('id')->on('cert_officers');
            $table->unsignedBigInteger('second_signee')->nullable();
            $table->foreign('second_signee')->references('id')->on('cert_officers');
            $table->string('prov_governor')->nullable();
            $table->string('cert_recipient');
            $table->string('cert_address')->nullable();
            $table->string('cert_entries_from')->nullable();
            $table->string('cert_entries_to')->nullable();
            $table->string('cert_details', 1000)->nullable();
            $table->string('notary_public', 1000)->nullable();
            // Transfer Tax Certification
            $table->integer('ptr_number')->nullable();
            $table->string('doc_number')->nullable();
            $table->integer('page_number')->nullable();
            $table->string('book_number')->nullable();
            $table->integer('cert_series')->nullable();
            $table->integer('ref_num')->nullable();
            // Sand & Gravel Certification
            $table->string('sg_processed')->nullable();
            $table->string('agg_basecourse')->nullable();
            $table->string('less_sandandgravel')->nullable();
            $table->string('less_boulders')->nullable();
            // Provincial Permit
            $table->string('prov_certclearance')->nullable();
            $table->string('prov_certtype')->nullable();
            $table->integer('prov_certbidding')->nullable();
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
        Schema::dropIfExists('certifications');
        Schema::create('certifications', function (Blueprint $table) {
            $table->softDeletes();
        });
    }
}
