<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('application_profile_id');
            $table->bigInteger("eiin")->nullable();
            $table->text("institution")->nullable();
            $table->text("head_name")->nullable();
            $table->text("institution_tel")->nullable();
            $table->text("institution_email")->nullable();
            $table->text("mpo")->nullable();
//            $table->enum('internet_connection', ['YES', 'NO'])->nullable();
//            $table->enum('internet_connection_type', ['broadband', 'modem'])->nullable();
//            $table->enum('ict_teacher', ['YES', 'NO'])->nullable();
//            $table->enum('good_result', ['YES', 'NO'])->nullable();
//            $table->longText('about_institution')->nullable();
            $table->bigInteger("total_girls")->nullable();
            $table->bigInteger("total_boys")->nullable();
            //$table->bigInteger("total_teachers")->nullable();
            //$table->enum("management",['GOVERNMENT','NON-GOVT.'])->nullable();
            //$table->enum("student_type",['CO-EDUCATION JOINT','GIRLS','BOYS'])->nullable();
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
        Schema::dropIfExists('application_profiles');
    }
}
