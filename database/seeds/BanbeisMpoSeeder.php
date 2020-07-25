<?php

use Illuminate\Database\Seeder;

class BanbeisMpoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = file_get_contents(database_path() . '/seeds/banbeis_mpos.sql');

        DB::statement($sql);
    }
}
