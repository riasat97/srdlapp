<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttributesToApplicationVerificationsNewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('application_verifications', function (Blueprint $table) {
            $table->string('lab_length')->nullable()->after('app_original_comments');
            $table->string('lab_width')->nullable()->after('lab_length');

            $table->enum('two_storey_building', ['YES', 'NO'])->nullable()->after('lab_width');
            $table->enum('lab_room_status', ['building', 'half_building','tin_shed'])->nullable()->after('two_storey_building');
            $table->enum('lab_window_status', ['iron', 'wood'])->nullable()->after('lab_room_status');
            $table->enum('boundary', ['YES', 'NO'])->nullable()->after('lab_window_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('application_verifications', function (Blueprint $table) {
            $table->dropColumn('lab_length');
            $table->dropColumn('lab_width');
            $table->dropColumn('two_storey_building');
            $table->dropColumn('lab_room_status');
            $table->dropColumn('lab_window_status');
            $table->dropColumn('boundary');

        });
    }
}
