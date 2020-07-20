<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AreaController extends Controller
{
    public function getDivisions()
    {
        $divisionList=[];
        $divisions = Area::distinct()->get("division")->toArray();
        foreach ($divisions as $key=>$division)
            $divisionList[$division['division']]=$division['division'];
        //dd($divisionList);
        return response()->json($divisionList);
    }
    public function getDistricts(Request $request)
    {
        //dd($request->divId);
        $districts = Area::
            where("division",$request->divId)
            ->groupBy('district')->pluck('district','district');
        //dd($districts);
        return response()->json($districts);
    }
    public function getUpazilas(Request $request)
    {
        $upazilas = Area::
        where("district",$request->disId)
        ->pluck('upazila','upazila');
        return response()->json($upazilas);
    }
}
