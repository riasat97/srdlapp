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
            $table->text('division')->nullable();
            $table->text('division_en')->nullable();
            $table->text('district')->nullable();
            $table->text('district_en')->nullable();
            $table->text('upazila')->nullable();
            $table->text('upazila_en')->nullable();
            $table->text('union_pourashava_ward')->nullable();
            $table->bigInteger('seat_no_en',false);
            $table->text('seat_no')->nullable();
            $table->text('parliamentary_constituency')->nullable();
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

//SELECT DISTINCT seat_no_en,parliamentary_constituency FROM `bangladesh` WHERE parliamentary_constituency like '%\t' \r \n
//https://stackoverflow.com/questions/17044316/mysql-removing-trailing-linebreaks-from-a-column
//https://stackoverflow.com/questions/6858143/how-to-remove-leading-and-trailing-whitespace-in-a-mysql-field
//UPDATE FOO set FIELD2 = TRIM(Replace(Replace(Replace(FIELD2,'\t',''),'\n',''),'\r',''));
//SELECT DISTINCT seat_no,parliamentary_constituency FROM `bangladesh` WHERE  (parliamentary_constituency REGEXP '(^[[:space:]]|[[:space:]]$)') order by seat_no_en
