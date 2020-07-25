<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddManagementStudentTypeToApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->enum("management",['GOVERNMENT','NON-GOVT.'])->after('total_teachers')->nullable();
            $table->enum("student_type",['CO-EDUCATION JOINT','GIRLS','BOYS'])->after('management')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn('management');
            $table->dropColumn('student_type');
        });
    }
}
