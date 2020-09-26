<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUpazilaEnDomainToBangladeshTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bangladesh', function (Blueprint $table) {
            $table->text('upazila_en_domain')->nullable()->after('upazila_en');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bangladesh', function (Blueprint $table) {
            $table->dropColumn('upazila_en_domain');
        });
    }
}
