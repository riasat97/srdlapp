<?php

use App\Imports\ApplicationsImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new ApplicationsImport(), database_path() . '/seeds/applications-p1.xlsx');
        echo "...finished!";

    }
}
