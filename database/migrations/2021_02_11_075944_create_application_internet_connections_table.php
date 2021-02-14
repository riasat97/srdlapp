<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationInternetConnectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_internet_connections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('application_id');

            $table->enum('internet_connection', ['YES', 'NO'])->nullable();
            $table->enum('broadband', ['YES', 'NO'])->nullable();
            $table->enum('modem', ['YES', 'NO'])->nullable();

            $table->enum('mobile_operators', ['YES', 'NO'])->nullable();
            $table->enum('gp', ['YES', 'NO'])->nullable();
            $table->enum('robi', ['YES', 'NO'])->nullable();
            $table->enum('banglalink', ['YES', 'NO'])->nullable();
            $table->enum('airtel', ['YES', 'NO'])->nullable();
            $table->enum('teletalk', ['YES', 'NO'])->nullable();
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
        Schema::dropIfExists('application_internet_connections');
    }
}
