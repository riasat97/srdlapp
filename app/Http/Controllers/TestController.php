<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Support\Arr;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class TestController extends ApplicationController
{

    public function test($subdomain){

        dd($subdomain);
        //dd(Auth::user()->hasPermissionTo('new application'));
//        $role= Role::where('name','super admin')->first();
//        $newApp= Permission::where('name','new application')->first();
//        $role->givePermissionTo($newApp);
          $role= Role::where('name','district admin')->first();
          Auth::user()->assignRole($role);
          return "role given to district admin";
    }
    public function generatePDF()
    {
        $application=Application::where('id',1012)->with('attachment','lab','verification','profile')->first();
        $labs=[];
        $tag= new \Spatie\Tags\Tag;
        $tags=\Spatie\Tags\Tag::all();
        foreach ($tags as $tag) {
            $labs[$tag->name]=$tag->translate('name', 'bn');
        }
        $selectedLabs=$this->getLabs($application,'lab');
        $listAttachmentFile= $this->getListAttachmentFile($application);
        $listAttachmentFilePathType=$this->getListAttachmentFilePathType($application);
        $ins_type= Arr::except(ins_type(),[""]);
        $ins_level= Arr::only(ins_level(), array('primary','junior_secondary','secondary','higher_secondary','secondary_and_higher',"graduation","others"));
        $ins_type_sof= Arr::only($ins_type, array('general', 'madrasha', 'technical'));
        $ins_level_sof= $array = Arr::only(ins_level(), array('secondary', 'secondary_and_higher'));
        $ins_level_technical= $array = Arr::only(ins_level(), array('junior_secondary','secondary','higher_secondary','secondary_and_higher',"diploma","others"));
        //dd($deo_app_seat_count);
        //dd(storage_path('fonts/'));
        $data = ['application'=>$application,"ins_type"=>$ins_type,"ins_level"=>$ins_level,
                "ins_type_sof"=>$ins_type_sof,"ins_level_sof"=>$ins_level_sof,
                "ins_level_technical"=>$ins_level_technical,'labs'=>$labs,'selectedLabs'=>$selectedLabs,
                'listAttachmentFile'=>$listAttachmentFile,'listAttachmentFilePathType'=>$listAttachmentFilePathType];
        //$pdf = \App::make('dompdf.wrapper');
        //$pdf->setOptions(['dpi' => 150, 'defaultFont' => 'Nikosh']);
        $pdf = PDF::loadView('applications.generate-pdf', $data);
        //$pdf = PDF::loadView('dashboard', $data);
        //$pdf->loadView('applications.generate-pdf', compact('data'));

        return $pdf->stream('codingdriver.pdf');
    }

}
