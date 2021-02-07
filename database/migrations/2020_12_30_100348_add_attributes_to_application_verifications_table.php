<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttributesToApplicationVerificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('application_verifications', function (Blueprint $table) {
            $table->enum('internet_connection', ['YES', 'NO'])->nullable()->after('lab_prepared');
            $table->enum('internet_connection_type', ['broadband', 'modem'])->nullable()->after('internet_connection');
            $table->enum('good_result', ['YES', 'NO'])->nullable()->after('internet_connection_type');
            $table->longText('about_institution')->nullable()->after('good_result');
            $table->enum('has_ict_teacher', ['YES', 'NO'])->nullable()->after('about_institution');
            $table->enum('app_upazila_verified', ['YES', 'NO'])->nullable()->after('has_ict_teacher');
            $table->enum('app_district_verified', ['YES', 'NO'])->nullable()->after('app_upazila_verified');
            $table->enum('app_duplicate', ['YES', 'NO'])->nullable()->after('app_district_verified');
            $table->unsignedBigInteger('app_original_id')->nullable()->after('app_duplicate');
            $table->text('app_original_comments')->nullable()->after('app_original_id');

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
            $table->dropColumn('internet_connection');
            $table->dropColumn('internet_connection_type');
            $table->dropColumn('good_result');
            $table->dropColumn('about_institution');
            $table->dropColumn('has_ict_teacher');
            $table->dropColumn('app_upazila_verified');
            $table->dropColumn('app_district_verified');
            $table->dropColumn('app_duplicate');
        });
    }
}
