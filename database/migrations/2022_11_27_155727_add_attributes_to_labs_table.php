<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttributesToLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('labs', function (Blueprint $table) {
            $table->string("institution_corrected")->nullable()->after('institution');
            $table->text("institution_en")->nullable()->after('institution_corrected');

            $table->bigInteger("total_boys")->nullable()->after('institution_email');
            $table->bigInteger("total_girls")->nullable()->after('total_boys');
            $table->string('total_teachers')->nullable()->after('total_girls');

            $table->double("latitude")->nullable()->after('total_teachers');
            $table->double("longitude")->nullable()->after('latitude');
            $table->enum('flag',[0,1])->nullable();
            $table->tinyInteger('updated')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('labs', function (Blueprint $table) {
            $table->dropColumn('institution_corrected');
            $table->dropColumn('institution_en');
            $table->dropColumn('total_boys');
            $table->dropColumn('total_girls');
            $table->dropColumn('total_teachers');
            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
            $table->dropColumn('flag');
            $table->dropColumn('updated');
        });
    }
}
