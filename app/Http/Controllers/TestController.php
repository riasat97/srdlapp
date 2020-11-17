<?php

namespace App\Http\Controllers;

use PDF;
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
    public function generatePDF()
    {
        //dd(storage_path('fonts/'));
        $data = [
            'title' => 'আর্থিক প্রতিষ্ঠান বিভাগ ',
            'heading' => 'আর্থিক প্রতিষ্ঠান বিভাগ',
            'content' => 'দুর্যোগ ব্যবস্থাপনা ও ত্রাণ মন্ত্রণালয়  ঠিকানা ',
            ];
        //$pdf = \App::make('dompdf.wrapper');
        //$pdf->setOptions(['dpi' => 150, 'defaultFont' => 'Nikosh']);
        $pdf = PDF::loadView('applications.generate-pdf', $data);
        //$pdf->loadView('applications.generate-pdf', compact('data'));

        return $pdf->stream('codingdriver.pdf');
    }

}
