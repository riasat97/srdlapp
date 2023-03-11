<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToTraineesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trainees', function (Blueprint $table) {
            $table->string("name_en")->nullable()->after('name');
            $table->string("nid")->nullable()->after('email');
            $table->string("training_title")->nullable()->after('nid');
            $table->string("training_duration")->nullable()->after('training_title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trainees', function (Blueprint $table) {
            $table->dropColumn('name_en');
            $table->dropColumn('nid');
            $table->dropColumn('training_title');
            $table->dropColumn('training_duration');
        });
    }
}
