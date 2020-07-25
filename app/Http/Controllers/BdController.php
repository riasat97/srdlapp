<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Bd;
use Illuminate\Http\Request;

class BdController extends Controller
{
    public function getDivisions()
    {
        $divisionList=[];
        $divisions = Bd::distinct()->get("division_en")->toArray();
        foreach ($divisions as $key=>$division)
            $divisionList[$division['division_en']]=$division['division_en'];
        //dd($divisionList);
        return response()->json($divisionList);
    }
    public function getDistricts(Request $request)
    {
        //dd($request->divId);
        $districts = Bd::
        where("division_en",$request->divId)
            ->groupBy('district_en')->pluck('district_en','district_en');
        //dd($districts);
        return response()->json($districts);
    }
    public function getUpazilas(Request $request)
    {
        $upazilas = Bd::
        where("district_en",$request->disId)
            ->pluck('upazila_en','upazila_en');
        return response()->json($upazilas);
    }
}
