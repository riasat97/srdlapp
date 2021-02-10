<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->enum('lab_type',['srdl','sof']);
            $table->enum("institution_type",['primary','school','college','school and college', 'madrasha','technical','university','gov_training','gov_rel_ins','others'])->nullable();
            $table->text("institution_bn");
            $table->text("division");
            $table->text("district");
            $table->text("upazila");
            $table->text("union_pourashava_ward")->nullable();
            $table->enum('seat_type',['general','reserved'])->nullable();
            $table->text("seat_no")->nullable();
            $table->text("parliamentary_constituency")->nullable();
            $table->enum("is_parliamentary_constituency_ok", ['YES', 'NO'])->nullable();
            $table->enum("listed_by_deo", ['YES', 'NO'])->nullable();
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
        Schema::dropIfExists('applications');
    }
}
