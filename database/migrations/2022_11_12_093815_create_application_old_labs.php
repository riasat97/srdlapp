<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationOldLabs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_old_labs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('application_id');
            $table->string('lab_title')->nullable();
            $table->string('year')->nullable();
            $table->string('desktop')->nullable();
            $table->string('active_desktop')->nullable();
            $table->string('laptop')->nullable();
            $table->string('active_laptop')->nullable();
            $table->longText('lab_comments')->nullable();
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
        Schema::dropIfExists('application_old_labs');
    }
}
