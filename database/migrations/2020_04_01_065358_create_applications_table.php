<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->enum('lab_type',['srdl','sof']);
            $table->enum("institution_type",['primary','school','college','school and college', 'madrasha','technical','university','gov_training','gov_rel_ins','others'])->nullable();
            $table->bigInteger("eiin");
            $table->text("institution_bn");
            $table->text("institution");
            $table->text("institution_email");
            $table->text("institution_tel");
            $table->text("division");
            $table->text("district");
            $table->text("upazila");
            $table->text("union_pourashava_ward");
            $table->enum('seat_type',['general','reserved']);
            $table->text("seat_no");
            $table->enum("is_parliamentary_constituency_ok", ['YES', 'NO'])->nullable();
            $table->enum("listed_by_deo", ['YES', 'NO'])->nullable();
            $table->text("member_name")->nullable();
            $table->string('list_attachment_file')->nullable();
            $table->string('list_attachment_file_path')->nullable();

            $table->text("mpo")->nullable();
            $table->bigInteger("total_girls");
            $table->bigInteger("total_boys");
            $table->bigInteger("total_teachers");
            $table->enum("management",['GOVERNMENT','NON-GOVT.'])->nullable();
            $table->enum("student_type",['CO-EDUCATION JOINT','GIRLS','BOYS'])->nullable();

            $table->enum('lab_by_srdl', ['YES', 'NO'])->nullable();
            $table->enum('lab_by_bcc', ['YES', 'NO'])->nullable();
            $table->enum('lab_by_moe', ['YES', 'NO'])->nullable();
            $table->enum('lab_by_dshe', ['YES', 'NO'])->nullable();
            $table->enum('lab_by_edu_board', ['YES', 'NO'])->nullable();
//            $table->enum('lab_by_ngo', ['YES', 'NO'])->nullable();
//            $table->enum('own_lab', ['YES', 'NO'])->nullable();
//            $table->enum('lab_by_local_gov', ['YES', 'NO'])->nullable();
            $table->enum('lab_by_others', ['YES', 'NO'])->nullable();

            $table->enum('internet_connection', ['YES', 'NO'])->nullable();
            $table->enum('internet_connection_type', ['broadband', 'modem'])->nullable();
            $table->enum('ict_edu', ['YES', 'NO'])->nullable();
            $table->enum('ict_teacher', ['YES', 'NO'])->nullable();

            $table->enum('electricity_solar', ['YES', 'NO'])->nullable();
            $table->enum('proper_room', ['YES', 'NO'])->nullable();
            $table->enum('proper_infrastructure', ['YES', 'NO'])->nullable();
            $table->enum('proper_security', ['YES', 'NO'])->nullable();

            $table->enum('good_result', ['YES', 'NO'])->nullable();
            $table->longText('about_institution')->nullable();

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
        Schema::dropIfExists('applications');
    }
}
