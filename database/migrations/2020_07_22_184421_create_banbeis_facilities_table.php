<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanbeisFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banbeis_facilities', function (Blueprint $table) {
            $table->id();
            $table->text("eiin");
            $table->enum("electricity", ['YES', 'NO'])->nullable();
            $table->enum("solar", ['YES', 'NO'])->nullable();
            $table->enum("cc_camera", ['YES', 'NO'])->nullable();
            $table->enum("security_guard", ['YES', 'NO'])->nullable();
            $table->enum("internet", ['YES', 'NO'])->nullable();
            $table->enum("ict_teacher", ['YES', 'NO'])->nullable();
            $table->enum("packa", ['YES', 'NO'])->nullable();
            $table->enum("semi_packa", ['YES', 'NO'])->nullable();
            $table->enum("kacha", ['YES', 'NO'])->nullable();
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
        Schema::dropIfExists('banbeis_facilities');
    }
}
