<?php

namespace App\Http\Controllers;

use App\Models\Application;
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
        $deo_app_seat_count= Application::where("listed_by_deo","YES")->whereNotLike('parliamentary_constituency', 'মহিলা আসন')->groupBy('seat_no')->get()->count();
        //dd($deo_app_seat_count);
        $deo_app_seat_total= Application::where("listed_by_deo","YES")->whereNotLike('parliamentary_constituency', 'মহিলা আসন')->count();
        $deo_app_reserved_seat_count= Application::where("listed_by_deo","YES")->whereLike('parliamentary_constituency', 'মহিলা আসন')->groupBy('seat_no')->get()->count();
        $deo_app_reserved_seat_total= Application::where("listed_by_deo","YES")->whereLike('parliamentary_constituency', 'মহিলা আসন')->count();
        $sof_total= Application::where("listed_by_deo","YES")->where("lab_type","sof")->groupBy('seat_no')->get()->count();
        $other_ref= Application::where("listed_by_deo","NO")->count();
        $total_app= Application::count();
        //dd($deo_app_seat_count);
        //dd(storage_path('fonts/'));
        $data = [
            'title' => 'আর্থিক প্রতিষ্ঠান বিভাগ ',
            'heading' => 'আর্থিক প্রতিষ্ঠান বিভাগ',
            'content' => 'দুর্যোগ ব্যবস্থাপনা ও ত্রাণ মন্ত্রণালয়  ঠিকানা ',
            'deo_app_seat_count'=>$deo_app_seat_count,
            'deo_app_seat_total'=>$deo_app_seat_total,
            'deo_app_reserved_seat_count'=>$deo_app_reserved_seat_count,
            'deo_app_reserved_seat_total'=>$deo_app_reserved_seat_total,
            'sof_total'=>$sof_total,
            'other_ref'=>$other_ref,
            'total_app'=>$total_app,
            ];
        //$pdf = \App::make('dompdf.wrapper');
        //$pdf->setOptions(['dpi' => 150, 'defaultFont' => 'Nikosh']);
        $pdf = PDF::loadView('applications.generate-pdf', $data);
        //$pdf = PDF::loadView('dashboard', $data);
        //$pdf->loadView('applications.generate-pdf', compact('data'));

        return $pdf->stream('codingdriver.pdf');
    }

}
