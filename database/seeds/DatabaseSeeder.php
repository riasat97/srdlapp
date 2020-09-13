<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(TagSeeder::class);
         $this->call(AreaSeeder::class);
         $this->call(BanbeisSeeder::class);
         $this->call(BanbeisFacilitiesSeeder::class);
         $this->call(BanbeisLabsSeeder::class);
         $this->call(BanbeisExtraSeeder::class);
         $this->call(BanbeisMpoSeeder::class);
         $this->call(BdSeeder::class);
         $this->call(BangladeshSeeder::class);
    }
}
