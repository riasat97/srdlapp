<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBangladeshTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bangladesh', function (Blueprint $table) {
            $table->id();
            $table->string('division',255)->nullable()->default('NULL');
            $table->string('district',255)->nullable()->default('NULL');
            $table->string('upazila',255)->nullable()->default('NULL');
            $table->string('union_pourashava_ward',255)->nullable()->default('NULL');
            $table->bigInteger('seat_no_en',false);
            $table->string('seat_no',255)->nullable()->default('NULL');
            $table->string('parliamentary_constituency',255)->nullable()->default('NULL');
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
        Schema::dropIfExists('bangladesh');
    }
}
