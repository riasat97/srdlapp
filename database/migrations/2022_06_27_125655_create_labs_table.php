<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labs', function (Blueprint $table) {
            $table->id();
            $table->integer('srdl_code');
            $table->enum('phase',[1,2]);

            $table->text("institution");
            $table->bigInteger("eiin")->nullable();
            $table->enum('lab_type',['srdl','sof','srdl_sof']);
            $table->string("institution_type")->nullable();
            $table->string('institution_level')->nullable();

            $table->text("division");
            $table->text("district");
            $table->text("upazila");
            $table->text("union_pourashava_ward")->nullable();
            $table->string("union_others")->nullable();
            $table->string("ward")->nullable();

            $table->enum('seat_type',['general','reserved'])->nullable();
            $table->text("seat_no_en")->nullable();
            $table->text("seat_no")->nullable();
            $table->text("parliamentary_constituency")->nullable();

            $table->text("head_name")->nullable();
            $table->text("institution_tel")->nullable();
            $table->text("institution_email")->nullable();
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
        Schema::dropIfExists('labs');
    }
}
