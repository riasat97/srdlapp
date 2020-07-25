<?php

namespace App\Http\Controllers;

use App\Models\Area;
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
        return view('computerlabs',['divisionList'=>$divisionList]);
    }

}
