<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->integer('lab_id');
            $table->string('device')->nullable();
            $table->enum('device_status',['active','inactive','stolen'])->nullable();
            $table->integer('quantity')->nullable();
            $table->text("problem")->nullable();
            $table->string('attachment_file')->nullable();
            $table->string('attachment_file_path')->nullable();
            $table->enum('support_status',['open','processing','resolved','unresolved','closed'])->nullable();
            $table->text("support_description")->nullable();
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
        Schema::dropIfExists('devices');
    }
}
