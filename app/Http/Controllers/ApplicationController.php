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
        $res= Banbeis::with('banbeisFacility')
            ->where('eiin',$eiin)->first();
        dd($res->toArray());

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
