<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = file_get_contents(database_path() . '/seeds/bd.sql');
        DB::statement($sql);
    }
}
