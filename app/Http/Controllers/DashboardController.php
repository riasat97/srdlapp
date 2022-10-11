<?php

namespace App\Http\Controllers;

use App\DataTables\ApplicationsDataTable;
use App\DataTables\SelectedInstitutionsDataTable;
use App\Models\Application;
use App\Models\Bangladesh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/
    public function index()
    {
        $deo_app_seat_count= Application::where("listed_by_deo","YES")->whereNotLike('parliamentary_constituency', 'মহিলা আসন')->groupBy('seat_no')->get()->count();
        //dd($deo_app_seat_count);
        $deo_app_seat_total= Application::where("listed_by_deo","YES")->whereNotLike('parliamentary_constituency', 'মহিলা আসন')->count();
        $deo_app_reserved_seat_count= Application::where("listed_by_deo","YES")->whereLike('parliamentary_constituency', 'মহিলা আসন')->groupBy('seat_no')->get()->count();
        $deo_app_reserved_seat_total= Application::where("listed_by_deo","YES")->whereLike('parliamentary_constituency', 'মহিলা আসন')->count();
        $sof_total= Application::where("lab_type","sof")->groupBy('seat_no')->get()->count();
        $other_ref= Application::where("listed_by_deo","NO")->count();
        $total_app= Application::count();
        //dd($deo_app_seat_count);
        return view('dashboard',['deo_app_seat_count'=>$deo_app_seat_count,'deo_app_seat_total'=>$deo_app_seat_total,
            'deo_app_reserved_seat_count'=>$deo_app_reserved_seat_count,'deo_app_reserved_seat_total'=>$deo_app_reserved_seat_total,
            'sof_total'=>$sof_total,'other_ref'=>$other_ref,'total_app'=>$total_app]);
    }

    public function application(SelectedInstitutionsDataTable $dataTable,Request $request)
    {
        $divisionList=[];
        $divisions = Bangladesh::distinct()->get("division")->toArray();
        foreach ($divisions as $key=>$division)
            $divisionList[$division['division']]=$division['division'];
        $divisionList=array_merge(['-1' => 'নির্বাচন করুন'], $divisionList);
        $parliamentaryConstituencyList= $this->getParliamentaryConstituency($request);
        return $dataTable->render('selectedInstitutions',['divisionList'=>$divisionList,'parliamentaryConstituencyList'=>$parliamentaryConstituencyList]);
    }

    public function getParliamentaryConstituency(Request $request)
    {
        // dd($request->all());
        //$user=Auth::user();
        //if($user->hasRole(['district admin','upazila admin'])){
            $parliament = Bangladesh::groupBy('parliamentary_constituency')
                ->orderBy('seat_no_en','asc')
                ->pluck('parliamentary_constituency','parliamentary_constituency');
            $parliament=array_merge(['-1' => 'নির্বাচন করুন'], $parliament->toArray());
            return $parliament;
       // }

    }
    public function getHome(){
        return view('index');
    }
    public function getAbout(){
        return view('about');
    }
}
