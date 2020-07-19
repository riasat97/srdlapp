<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreaTable extends Migration
{
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {

		$table->increments('id')->start_from(0);
		$table->text('division');
		$table->text('district');
		$table->text('upazila');

        });
    }

    public function down()
    {
        Schema::dropIfExists('areas');
    }
}
