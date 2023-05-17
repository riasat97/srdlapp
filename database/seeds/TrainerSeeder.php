<?php

use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class TrainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $trainers=User::whereBetween('id', [1170, 1178])->get();
        $role= Role::where('name','trainer')->first();
        foreach ($trainers as $trainer){
            $trainer->assignRole($role);
        }
    }
}
