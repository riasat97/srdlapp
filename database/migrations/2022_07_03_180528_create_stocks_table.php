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
            $table->unsignedBigInteger('lab_id');
            $table->string('contract');
            $table->string('renovation');
            $table->string('laptop');
            $table->string('printer');
            $table->string('scanner');
            $table->string('router');
            $table->string('network_switch');
            $table->string('led_tv');
            $table->string('webcam');
            $table->string('networking');
            $table->string('furniture');
            $table->string('sof_contract');
            $table->string('smart_board');
            $table->string('desktop');
            $table->string('industrial_router');
            $table->string('attendance_reader');
            $table->string('digital_id_card');
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
