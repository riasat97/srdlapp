<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttributesToApplicationAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('application_attachments', function (Blueprint $table) {
            $table->string('verification_report_file')->nullable()->after('old_application_attachment_path');
            $table->string('verification_report_file_path')->nullable()->after('verification_report_file');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('application_attachments', function (Blueprint $table) {
            $table->dropColumn('verification_report_file');
            $table->dropColumn('verification_report_file_path');
        });
    }
}
