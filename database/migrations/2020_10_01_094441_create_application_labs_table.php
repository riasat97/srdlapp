<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_labs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('application_lab_id');
            $table->enum('lab_by_srdl', ['YES', 'NO'])->nullable();
            $table->enum('lab_by_bcc', ['YES', 'NO'])->nullable();
            $table->enum('lab_by_moe', ['YES', 'NO'])->nullable();
            $table->enum('lab_by_dshe', ['YES', 'NO'])->nullable();
            $table->enum('lab_by_edu_board', ['YES', 'NO'])->nullable();
//            $table->enum('lab_by_ngo', ['YES', 'NO'])->nullable();
//            $table->enum('own_lab', ['YES', 'NO'])->nullable();
//            $table->enum('lab_by_local_gov', ['YES', 'NO'])->nullable();
            $table->enum('lab_by_others', ['YES', 'NO'])->nullable();
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
        Schema::dropIfExists('application_labs');
    }
}