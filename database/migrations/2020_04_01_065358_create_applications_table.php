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
            $table->text("institution_bn");
            $table->text("institution");           
            $table->enum("institution_type",['primary','school','college','school and college', 'madrasha','technical','gov_university','others'])->nullable();
            $table->text("institution_email");           
            $table->text("institution_tel");    
            $table->text("division");
            $table->text("district");
            $table->text("upazila");
            $table->text("eiin");
            $table->text("mpo");
            $table->text("total_girls");           
            $table->text("total_boys");
            $table->text("total_teachers");

            $table->enum('lab_by_srdl', ['YES', 'NO'])->nullable();
            $table->enum('lab_by_bcc', ['YES', 'NO'])->nullable();
            $table->enum('lab_by_moe', ['YES', 'NO'])->nullable();
            $table->enum('lab_by_dshe', ['YES', 'NO'])->nullable();
            $table->enum('lab_by_edu_board', ['YES', 'NO'])->nullable();
            $table->enum('lab_by_ngo', ['YES', 'NO'])->nullable();
            $table->enum('own_lab', ['YES', 'NO'])->nullable();
            $table->enum('lab_by_local_gov', ['YES', 'NO'])->nullable();
            $table->enum('lab_by_others', ['YES', 'NO'])->nullable();

            $table->integer('total_pc_own')->default(0);
            $table->integer('total_pc_gov_non_gov')->default(0);


            $table->enum('internet_connection', ['YES', 'NO'])->nullable();
            $table->enum('internet_connection_type', ['broadband', 'modem'])->nullable();          
            $table->enum('ict_teacher', ['YES', 'NO'])->nullable();

            $table->enum('electricity_solar', ['YES', 'NO'])->nullable();
            $table->enum('packa_semi_packa', ['YES', 'NO'])->nullable();
            $table->enum('boundary_wall', ['YES', 'NO'])->nullable();

            $table->enum('cctv', ['YES', 'NO'])->nullable();
            $table->enum('security_guard', ['YES', 'NO'])->nullable();
            $table->enum('night_guard', ['YES', 'NO'])->nullable();
            $table->longText('about_institution')->nullable();
          
            $table->string('ref_type')->nullable();
            $table->string('ref_name')->nullable();
            $table->string('ref_designation')->nullable();           
            $table->string('ref_documents_file')->nullable();

            $table->timestamp('old_application_date')->nullable();   
            $table->string('old_application_attachment')->nullable();
            $table->string('signature')->nullable();               
           
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
