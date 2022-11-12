    <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttributesToApplicationProfilesnewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('application_profiles', function (Blueprint $table) {
            $table->string('total_teachers')->nullable()->after('total_boys');
            $table->string('total_computer_trained_teachers')->nullable()->after('total_teachers');
            $table->string('total_staffs')->nullable()->after('total_computer_trained_teachers');
            $table->string('total_computer_trained_staffs')->nullable()->after('total_staffs');
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
            $table->dropColumn('total_teachers');
            $table->dropColumn('total_computer_trained_teachers');
            $table->dropColumn('total_staffs');
            $table->dropColumn('total_computer_trained_staffs');
        });
    }
}
