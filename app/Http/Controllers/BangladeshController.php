<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Bangladesh;
use App\Models\Bd;
use Illuminate\Http\Request;

class BangladeshController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getDivisions()
    {
        $divisionList=[];
        $divisions = Bangladesh::distinct()->get("division")->toArray();
        foreach ($divisions as $key=>$division)
            $divisionList[$division['division']]=$division['division'];
        //dd($divisionList);
        return response()->json($divisionList);
    }

    public function getDistricts(Request $request)
    {
        //dd($request->divId);
        $districts = Bangladesh::
        where("division",$request->divId)
            ->groupBy('district')->pluck('district','district');
        //dd($districts);
        return response()->json($districts);
    }

    public function getUpazilas(Request $request)
    {
        $upazilas = Bangladesh::
        where("district",$request->disId)
            ->pluck('upazila','upazila');
        return response()->json(['upazilas'=>$upazilas]);
    }
    public function getUnionPourashavaWards(Request $request)
    {
        $union_pourashava_wards = Bangladesh::
        where("district",$request->disId)
        ->where("upazila",$request->upazilaId)
            ->pluck('union_pourashava_ward','union_pourashava_ward');

        $parliament = Bangladesh::distinct()
            ->where("district",$request->disId)
            ->where("upazila",$request->upazilaId)
            ->orderBy('seat_no_en','asc')
            ->get(['seat_no_en','seat_no','parliamentary_constituency']);
        return response()->json(['union_pourashava_wards'=>$union_pourashava_wards,'parliament'=>$parliament]);
    }
    public function getParliamentaryConstituency(Request $request)
    {
       // dd($request->all());
        if(empty($request->unionPourashavaWardId)){
            //return true;
            $parliament = Bangladesh::distinct()
            ->where("district",$request->disId)
             //   ->where("upazila",$request->upazilaId)
              ->orderBy('seat_no_en','asc')
                ->get(['seat_no_en','seat_no','parliamentary_constituency']);
            return response()->json(['parliament'=>$parliament]);
        }
        $parliament = Bangladesh::
        where("district",$request->disId)
            ->where("upazila",$request->upazilaId)
            -> where("union_pourashava_ward",$request->unionPourashavaWardId)
            ->first(['seat_no_en','seat_no','parliamentary_constituency']);
        return response()->json(['parliament'=>$parliament]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bangladesh  $bangladesh
     * @return \Illuminate\Http\Response
     */
    public function show(Bangladesh $bangladesh)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bangladesh  $bangladesh
     * @return \Illuminate\Http\Response
     */
    public function edit(Bangladesh $bangladesh)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bangladesh  $bangladesh
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bangladesh $bangladesh)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bangladesh  $bangladesh
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bangladesh $bangladesh)
    {
        //
    }

    public function getReservedSeats(Request $request){
        $reservedSeats= ReservedSeats();
        return response()->json(['reserved_seats'=>$reservedSeats]);
    }
}
