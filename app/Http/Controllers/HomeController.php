<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Banbeis;
use App\Models\Bd;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('homepage');
    }
    public function getComputerLabs(){
        $divisionList=[];
        $divisions = Bd::distinct()->get("division_en")->toArray();
        foreach ($divisions as $key=>$division)
            $divisionList[$division['division_en']]=$division['division_en'];
        $labs= Banbeis::with('banbeisLab')->limit(100)->get();
        return view('computerlabs',['divisionList'=>$divisionList,'labs'=>$labs]);
    }
    public function getSearchLabs(Request $request){

        $labs= Banbeis::query();
        if($request->has('division'))
            $labs->where('division', $request->input('division'));

        if($request->has('district'))
             $labs->where('district', $request->input('district'));

        if($request->has('upazila'))
             $labs->where('upazila', $request->input('upazila'));

        //$labs=$labs->limit(100)->get();
        //dd();
        $divisionList=[];
        $divisions = Bd::distinct()->get("division_en")->toArray();
        foreach ($divisions as $key=>$division)
            $divisionList[$division['division_en']]=$division['division_en'];
        $division=$request->get('division');
        $district=$request->get('district');
        $upazila=$request->get('upazila');
        return view('computerLabs', ['division'=>$division,'district'=>$district,'upazila'=>$upazila,'labs'=>$labs->with('banbeisLab')->limit(100)->get(),'divisionList'=>$divisionList]);
    }

}
