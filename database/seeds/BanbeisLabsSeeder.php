<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BanbeisLabsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = file_get_contents(database_path() . '/seeds/banbeis_labs.sql');
        DB::statement($sql);
    }
}
