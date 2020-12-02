<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $deo_app_seat_count= Application::where("listed_by_deo","YES")->groupBy('seat_no')->get()->count();
        //dd($deo_app_seat_count);
        $deo_app_seat_total= Application::where("listed_by_deo","YES")->count();
        $deo_app_reserved_seat_count= Application::where("listed_by_deo","YES")->whereLike('parliamentary_constituency', 'মহিলা আসন')->groupBy('seat_no')->get()->count();
        $deo_app_reserved_seat_total= Application::where("listed_by_deo","YES")->whereLike('parliamentary_constituency', 'মহিলা আসন')->count();
        $sof_total= Application::where("listed_by_deo","YES")->where("lab_type","sof")->groupBy('seat_no')->get()->count();
        $other_ref= Application::where("listed_by_deo","NO")->count();
        $total_app= Application::count();
        //dd($deo_app_seat_count);
        return view('dashboard',['deo_app_seat_count'=>$deo_app_seat_count,'deo_app_seat_total'=>$deo_app_seat_total,
            'deo_app_reserved_seat_count'=>$deo_app_reserved_seat_count,'deo_app_reserved_seat_total'=>$deo_app_reserved_seat_total,
            'sof_total'=>$sof_total,'other_ref'=>$other_ref,'total_app'=>$total_app]);
    }
}
