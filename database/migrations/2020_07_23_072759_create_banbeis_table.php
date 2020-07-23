<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanbeisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banbeis', function (Blueprint $table) {
            $table->id();
            $table->string('division')->nullable();
            $table->string('district')->nullable();
            $table->string('upazila')->nullable();
            $table->enum('city_corporation',['Dhaka North City Corporation','Dhaka South City Corporation','Chattogram City Corporation','Khulna City Corporation','Rajshahi City Corporation'])->nullable();
            $table->enum('thana',['Yes','No','Kotwali'])->nullable();
            $table->string('eiin')->nullable();
            $table->string('institution')->nullable();
            $table->enum('institution_type',['primary','school','college','school and college','madrasha','technical','gov_university','others'])->nullable();
            $table->enum('head_designation',['principal','supper','head master',''])->nullable();
            $table->bigInteger('total_students',false)->default('0');
            $table->bigInteger('total_girls',false)->default('0');
            $table->bigInteger('total_teachers',false)->default('0');
            $table->bigInteger('total_teachers_female',false)->default('0');
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
        Schema::dropIfExists('banbeis');
    }
}
