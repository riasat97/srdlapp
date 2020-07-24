<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bd', function (Blueprint $table) {
            $table->id();
            $table->string('division_en',255);
            $table->string('division',255)->nullable()->default('NULL');
            $table->string('district_en',255);
            $table->string('district',255)->nullable()->default('NULL');
            $table->string('upazila_en',255);
            $table->string('upazila',255)->nullable()->default('NULL');
            $table->string('division_lat',255)->nullable()->default('NULL');
            $table->string('division_long',255)->nullable()->default('NULL');
            $table->string('district_lat',255)->nullable()->default('NULL');
            $table->string('district_long',255)->nullable()->default('NULL');
            $table->string('upazila_lat',255)->nullable()->default('NULL');
            $table->string('upazila_long',255)->nullable()->default('NULL');
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
        Schema::dropIfExists('bd');
    }
}
