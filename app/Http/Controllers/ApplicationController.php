<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function create()

    {
        $labs=[];
        $tag= new \Spatie\Tags\Tag;
        $tags=\Spatie\Tags\Tag::all();
        foreach ($tags as $tag) {
            $labs[$tag->name]=$tag->translate('name', 'bn');
        }
       // dd($labs);
        return view('applications.create',['labs'=>$labs]);
    }

  
    public function store(Request $request)
    {
        dump($request->all());
    }
}
