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
            $divisionList[$key+1]=$division['division'];
        //dd($divisionList);
        return view('index',compact('divisionList'));
    }
    public function getDistricts(Request $request)
    {
        $states = DB::table("areas")
            ->pluck("division","id");
        dd($states);
        return response()->json($states);
    }
    public function getUpazilas(Request $request)
    {
        $cities = DB::table("cities")
            ->where("state_id",$request->state_id)
            ->lists("name","id");
        return response()->json($cities);
    }
}
