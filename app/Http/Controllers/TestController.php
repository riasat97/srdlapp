<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class TestController extends Controller
{

    public function test($subdomain){

        dd($subdomain);
        //dd(Auth::user()->hasPermissionTo('new application'));
//        $role= Role::where('name','super admin')->first();
//        $newApp= Permission::where('name','new application')->first();
//        $role->givePermissionTo($newApp);
          $role= Role::where('name','district admin')->first();
          Auth::user()->assignRole($role);
          return "role given to district admin";
    }
}
