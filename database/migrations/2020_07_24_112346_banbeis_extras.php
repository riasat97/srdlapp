<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BanbeisExtras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banbeis_extras', function (Blueprint $table) {
        $table->id();
        $table->string('eiin')->nullable();
        $table->string('address')->nullable();
        $table->string('mobile')->nullable();
        $table->string('management')->nullable();
        $table->string('edu_type')->nullable();
        $table->string('student_type')->nullable();
        $table->string('affiliation')->nullable();
        $table->string('area')->nullable();
        $table->string('geography')->nullable();
        $table->string('disaster_area')->nullable();;
        $table->bigInteger('class_room',false)->default('0');
        $table->bigInteger('total_pc',false)->default('0');
        $table->bigInteger('own_pc',false)->default('0');
        $table->bigInteger('lab_usage_hr',false)->default('0');
        $table->bigInteger('total_lab_pc',false)->default('0');
        $table->bigInteger('jsc_total',false)->default('0');
        $table->bigInteger('jsc_pass',false)->default('0');
        $table->bigInteger('ssc_total',false)->default('0');
        $table->bigInteger('ssc_pass',false)->default('0');
        $table->bigInteger('hsc_total',false)->default('0');
        $table->bigInteger('hsc_pass',false)->default('0');
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
        Schema::dropIfExists('banbeis_extras');
    }
}
