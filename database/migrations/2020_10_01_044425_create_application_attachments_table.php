<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('application_attachment_id');
            $table->text("member_name")->nullable();
            $table->string('list_attachment_file')->nullable();
            $table->string('list_attachment_file_path')->nullable();

            $table->string('ref_type')->nullable();
            $table->string('ref_name')->nullable();
            $table->string('ref_designation')->nullable();
            $table->string('ref_office')->nullable();
            $table->string('ref_documents_file')->nullable();
            $table->string('ref_documents_file_path')->nullable();

            $table->timestamp('old_application_date')->nullable();
            $table->string('old_application_attachment')->nullable();
            $table->string('old_application_attachment_path')->nullable();

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
        Schema::dropIfExists('application_attachments');
    }
}
