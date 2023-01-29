<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $vendors=User::whereBetween('id', [590, 599])->get();
        $role= Role::where('name','vendor')->first();

        foreach ($vendors as $vendor){
            $vendor->assignRole($role);
        }
    }
}
