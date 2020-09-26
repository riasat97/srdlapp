<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data= [['name'=>'super admin','guard_name'=>'web'],['name'=>'district admin','guard_name'=>'web'],
                ['name'=>'upazila admin','guard_name'=>'web']];
        Role::insert($data);
        $data= [['name'=>'new application','guard_name'=>'web']];
        Permission::insert($data);

    }
}
