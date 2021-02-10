<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttributesToApplicationProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('application_profiles', function (Blueprint $table) {

            $table->string('management')->nullable()->after('eiin');
            $table->string("institution_corrected")->nullable()->after('management');
            $table->string("union_others")->nullable()->after('institution');
            $table->string("ward")->nullable()->after('union_others');
            $table->text("village_road")->nullable()->after('ward');
            $table->string("post_office")->nullable()->after('village_road');
            $table->integer("post_code")->nullable()->after('post_office');
            $table->decimal("distance_from_upazila_complex")->nullable()->after('post_code');
            $table->string("direction")->nullable()->after('distance_from_upazila_complex');
            $table->enum("proper_road", ['YES', 'NO'])->nullable()->after('direction');
            $table->double("latitude")->nullable()->after('proper_road');
            $table->double("longitude")->nullable()->after('latitude');

            $table->text("alt_name")->nullable()->after('institution_email');
            $table->text("alt_tel")->nullable()->after('alt_name');
            $table->text("alt_email")->nullable()->after('alt_tel');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('application_profiles', function (Blueprint $table) {

            $table->dropColumn('management');
            $table->dropColumn('institution_corrected');
            $table->dropColumn("union_others");
            $table->dropColumn("ward");
            $table->dropColumn("village_road");
            $table->dropColumn("post_office");
            $table->dropColumn("post_code");
            $table->dropColumn("distance_from_upazila_complex");
            $table->dropColumn("direction");
            $table->dropColumn("proper_road");
            $table->dropColumn("latitude");
            $table->dropColumn("longitude");

            $table->dropColumn("alt_name");
            $table->dropColumn("alt_tel");
            $table->dropColumn("alt_email");
        });
    }
}
