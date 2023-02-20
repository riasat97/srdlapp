<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTraineesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lab_id');
            $table->unsignedBigInteger('batch_id');
            $table->string('name')->nullable();
            $table->string('designation')->nullable();
            $table->string('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('qualification')->nullable();
            $table->string('subject')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            /*$table->enum('verified', ['YES', 'NO'])->nullable();
            $table->dateTimeTz('signature_at')->nullable();*/
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
        Schema::dropIfExists('trainees');
    }
}
