<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationVerificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_verifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('application_verification_id');
            $table->enum('govlab', ['YES', 'NO'])->nullable();
            $table->enum('proper_infrastructure', ['YES', 'NO'])->nullable();
            $table->enum('ict_edu', ['YES', 'NO'])->nullable();
            $table->enum('electricity_solar', ['YES', 'NO'])->nullable();
            $table->enum('proper_room', ['YES', 'NO'])->nullable();
            $table->enum('proper_security', ['YES', 'NO'])->nullable();
            $table->enum('lab_maintenance', ['YES', 'NO'])->nullable();
            $table->enum('lab_prepared', ['YES', 'NO'])->nullable();

            $table->enum('is_eiin', ['YES', 'NO'])->nullable();
            $table->enum('is_mpo', ['YES', 'NO'])->nullable();
            $table->enum('is_broadband', ['YES', 'NO'])->nullable();

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
        Schema::dropIfExists('application_verifications');
    }
}
