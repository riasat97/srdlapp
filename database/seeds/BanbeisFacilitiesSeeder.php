<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BanbeisFacilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = file_get_contents(database_path() . '/seeds/banbeis_facilities.sql');
        DB::statement($sql);
    }
}
