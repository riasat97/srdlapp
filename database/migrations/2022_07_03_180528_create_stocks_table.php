<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('lab_id')->nullable();
            $table->string('contract')->nullable();
            $table->string('renovation')->nullable();
            $table->string('laptop')->nullable();
            $table->string('printer')->nullable();
            $table->string('scanner')->nullable();
            $table->string('router')->nullable();
            $table->string('network_switch')->nullable();
            $table->string('led_tv')->nullable();
            $table->string('webcam')->nullable();
            $table->string('networking')->nullable();
            $table->string('furniture')->nullable();
            $table->string('sof_contract')->nullable();
            $table->string('smart_board')->nullable();
            $table->string('desktop')->nullable();
            $table->string('industrial_router')->nullable();
            $table->string('attendance_reader')->nullable();
            $table->string('digital_id_card')->nullable();
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
        Schema::drop('stocks');
    }
}
