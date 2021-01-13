<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddAttributesToApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->string('institution_level')->nullable()->after('institution_type');
            $table->string('status')->nullable()->after('listed_by_deo');
            //DB::statement("ALTER TABLE applications CHANGE COLUMN institution_type institution_type ENUM('general', 'madrasha','technical','gov_training','gov_rel_ins','others')");
            $table->text('institution_type')->change();

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
            $table->dropColumn('institution_level');
            $table->dropColumn('institution_type');
            $table->dropColumn('status');
        });
    }
}
