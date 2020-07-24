<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Banbeis;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function  terms(){
        return view('applications.terms');
    }
    public function create()

    {

        $labs=[];
        $tag= new \Spatie\Tags\Tag;
        $tags=\Spatie\Tags\Tag::all();
        foreach ($tags as $tag) {
            $labs[$tag->name]=$tag->translate('name', 'bn');
        }
       // dd($labs);
        $divisionList=[];
        $divisions = Area::distinct()->get("division")->toArray();
        foreach ($divisions as $key=>$division)
            $divisionList[$division['division']]=$division['division'];
        return view('applications.create',['labs'=>$labs,'divisionList'=>$divisionList]);
    }

    public function getValuesByEiin(Request $request){
        $eiin= $request->eiin;
        //$res= Banbeis::with('banbeisFacility','banbeisLab')->where('eiin',$eiin)->first();

        if($eiin == ''){
            $res = Banbeis::with('banbeisFacility','banbeisLab','banbeisExtra')->limit(5)->get();
        }else{
            $res = Banbeis::with('banbeisFacility','banbeisLab','banbeisExtra')->where('eiin', 'like', '%' .$eiin . '%')->limit(5)->get();
            $area= Banbeis::join('bd', function($q)
            {
                $q->on('bd.division_en', '=', 'banbeis.division')
                    ->on('bd.district_en', '=', 'banbeis.district')
                    ->on('bd.upazila_en', '=', 'banbeis.upazila');
            })->where('banbeis.eiin',$eiin)->get(['bd.division', 'bd.district','bd.upazila']);
        }

        $response = array();
        $areaRes= array();
        //dd($area);
        foreach ($area  as $ar){
            $areaRes[]=['division'=>$ar->division,
                'district'=> $ar->district,
                'upazila'=>$ar->upazila];
        }
        //dd($areaRes);
        foreach($res as $rs){
            $electricity_solar=($rs->banbeisFacility->electricity=="YES")?$rs->banbeisFacility->electricity:$rs->banbeisFacility->solar;
            $packa_semi_packa=($rs->banbeisFacility->packa=="YES" || $rs->banbeisFacility->semi_packa=="YES")?"YES":"NO";
            $response[] = ['value' => $rs->institution,
                'label'=>$rs->eiin,'mobile'=>$rs->banbeisExtra->mobile,
                'ex'=>$res,
                'area'=> $areaRes,
                'total_boys'=>$rs->total_students-$rs->total_girls,'total_girls'=>$rs->total_girls,'total_teachers'=>$rs->total_teachers,
                'internet_connection'=>$rs->banbeisFacility->internet,'ict_teacher'=>$rs->banbeisFacility->ict_teacher,
                'packa_semi_packa'=>$packa_semi_packa,
                'electricity_solar'=>$electricity_solar,'cctv'=>$rs->banbeisFacility->cc_camera,'security_guard'=>$rs->banbeisFacility->security_guard]  ;
        }

        return response()->json($response);

    }


    public function store(Request $request)
    {
        dump($request->all());
    }

    public function sms(){
        $client = new Client(['base_uri' => 'https://api.mobireach.com.bd/SendTextMessage']);

//        $response = $client->request('GET', '', ['query' => ['Username' => 'srdl',
//            "Password" => "Doict97!","From"=>"SRDL","To"=>"8801672702437","Message"=>"Faria kutta"]]);

        $response = $client->request('POST', '', ['form_params' => [
            'Username' => 'srdl',
            'Password' => 'Doict97!',
            'From'=>'SRDL',
            'To'=>'8801673556748',
            'Message'=>'Shuvo Gutibaz'
        ]]);


        echo $response->getBody();
    }
}
