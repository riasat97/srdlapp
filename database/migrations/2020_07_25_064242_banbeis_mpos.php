<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BanbeisMpos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banbeis_mpos', function (Blueprint $table) {
            $table->id();
            $table->string('eiin',255)->nullable();
            $table->string('mpo_school',255)->nullable();
            $table->string('mpo_college',255)->nullable();
            $table->string('mpo_madrasha',255)->nullable();
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
        Schema::dropIfExists('banbeis_mpos');

    }
}
