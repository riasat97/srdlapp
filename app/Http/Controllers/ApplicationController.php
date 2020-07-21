<?php

namespace App\Http\Controllers;

use App\Models\Area;
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


    public function store(Request $request)
    {
        dump($request->all());
    }
}
