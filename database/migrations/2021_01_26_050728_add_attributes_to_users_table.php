<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttributesToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('verified', ['YES', 'NO'])->nullable()->after('password');
            $table->dateTimeTz('signature_at')->nullable()->after('verified');
            $table->string('status')->nullable()->after('signature_at');
            $table->string('posting_type')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('signature_at');
            $table->dropColumn('posting_type');
            $table->dropColumn('verified');
        });
    }
}
