<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Batch;
use App\Models\Trainee;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Mpdf\QrCode\QrCode;
use Mpdf\QrCode\Output;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class TestController extends ApplicationController
{
    public function test(){
        $batches = Batch::get();
        //dd($batches->toArray());
        foreach ($batches as $batch){
            // Calculate the date after 10 days from the batch start date
            $batchStartDate= $batch->batch_start_date;
            $batchId= $batch->batch;
            $user_id= $batch->user_id;
            $completionDate = Carbon::parse($batchStartDate)->addDays(10);

            // Check if the current date is equal to or greater than the completion date
            if (Carbon::now()->greaterThanOrEqualTo($completionDate)) {
                // Update trainees' status to "completed" for the given batch
                Trainee::where('batch', $batchId)->whereHas('lab', function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                })->update(['status' => 1]);
            }
        }
        dd('passed');
    }

//    public function test($subdomain){
//
//        dd($subdomain);
//        //dd(Auth::user()->hasPermissionTo('new application'));
////        $role= Role::where('name','super admin')->first();
////        $newApp= Permission::where('name','new application')->first();
////        $role->givePermissionTo($newApp);
//          $role= Role::where('name','district admin')->first();
//          Auth::user()->assignRole($role);
//          return "role given to district admin";
//    }
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
        $config = ['instanceConfigurator' => function($mpdf) {
            $mpdf->SetWatermarkImage('../images/srdl.png');
            $mpdf->showWatermarkImage = true;

        }];
        $pdf = PDF::loadView('applications.generate-pdf', $data, [], $config);
        //$pdf = PDF::loadView('dashboard', $data);
        //$pdf->loadView('applications.generate-pdf', compact('data'));
        return $pdf->stream('codingdriver.pdf');
    }



    public function createPdf($id,Request $request)
    {
        $manual=false;
        if ($request->has('type')) {
            $type = $request->get('type');
            $manual= ($type=='manual')?true:false;
        }
        $application=Application::where('id',$id)->with('attachment','lab','verification','profile')->first();
        if(!Auth::user()->hasRole(['super admin','district admin','upazila admin']) or !permitted($application))
            return abort(404);
        $labs=[];
        $tag= new \Spatie\Tags\Tag;
        $tags=\Spatie\Tags\Tag::all();
        foreach ($tags as $tag) {
            $labs[$tag->name]=$tag->translate('name', 'bn');
        }
        $user=$this->getDistrictAndUpazilaAdminFromApplication($application->id);
        $recommender= $user['upazila_admin']->designation!=""?designations()[$user['upazila_admin']->designation]:"উপজেলা নির্বাহী অফিসার";
        //dd($user);
        $selectedLabs=$this->getLabs($application,'lab');
        $listAttachmentFile= $this->getListAttachmentFile($application);
        $listAttachmentFilePathType=$this->getListAttachmentFilePathType($application);
        $ins_type= Arr::except(ins_type(),[""]);
        $ins_level= Arr::only(ins_level(), array('primary','junior_secondary','secondary','higher_secondary','secondary_and_higher',"graduation","others"));
        $ins_type_sof= Arr::only($ins_type, array('general', 'madrasha', 'technical'));
        $ins_level_sof= $array = Arr::only(ins_level(), array('secondary', 'secondary_and_higher'));
        $ins_level_technical= $array = Arr::only(ins_level(), array('junior_secondary','secondary','higher_secondary','secondary_and_higher',"diploma","others"));
        $districtVerified=$this->getDistrictVerificationStatus(Auth::user());
        //dd($deo_app_seat_count);
        //dd(storage_path('fonts/'));
        $qrCode = new QrCode(route('applications.show',$application->id ));

        $qr = new Output\Png();

// Save black on white PNG image 100px wide to filename.png
        //$qr->output($qrCode, 100, [255, 255, 255], [0, 0, 0], public_path('images/qr.png'));
        file_put_contents(public_path('images/qr.png'), $qr->output($qrCode, 100, [255, 255, 255], [0, 0, 0]));
        $data = ['application'=>$application,"ins_type"=>$ins_type,"ins_level"=>$ins_level,
            "ins_type_sof"=>$ins_type_sof,"ins_level_sof"=>$ins_level_sof,
            "ins_level_technical"=>$ins_level_technical,'labs'=>$labs,'selectedLabs'=>$selectedLabs,
            'listAttachmentFile'=>$listAttachmentFile,'listAttachmentFilePathType'=>$listAttachmentFilePathType,
            'districtVerified'=>$districtVerified,'qr'=>$qr,'manual'=>$manual,'user'=>$user,'recommender'=>$recommender ];
        //$pdf = \App::make('dompdf.wrapper');
        //$pdf->setOptions(['dpi' => 150, 'defaultFont' => 'Nikosh']);
        $config = ['instanceConfigurator' => function($mpdf) {
            $mpdf->SetWatermarkImage('../images/srdl.png');
            $mpdf->showWatermarkImage = true;

        }];
         $pdf = PDF::loadView('applications.create-pdf', $data, [], $config);
        //$pdf = PDF::loadView('dashboard', $data);
        //$pdf->loadView('applications.generate-pdf', compact('data'));

//        return loadView('applications.create-pdf');
        if($manual)  return $pdf->download($application->id.'-srdl-verification-form.pdf');;
        return $pdf->stream($application->id.'-srdl-digital-copy.pdf');
    }

    private function getDistrictVerificationStatus($user)
    {
        if($user->hasRole('upazila admin')){
            $upazila_en=explode('_',$user->username)[0];
            $district_en=explode('_',$user->username)[1];
            $district_username= $district_en.'_admin';
            $district_user= User::where('username',$district_username)->first();
            if($district_user->verified=='YES') return true;
            else false;
        }
        return false;
    }
    public function getDistrictAndUpazilaAdminFromApplication( $application){
        $user= Application::where('applications.id',$application)
            ->join('bangladesh', function($q)
            {
                $q->on('bangladesh.district','=','applications.district')
                    ->on('bangladesh.upazila','=','applications.upazila');
            })
            ->first();
          //dd($user->toArray());
        $district_admin_match= Str::lower($user->district_en).'_admin';
        $upazila_admin_match= Str::lower($user->upazila_en_domain).'_'.Str::lower($user->district_en).'_admin';
        $district_admin= User::where('username',$district_admin_match)->first();
        $upazila_admin= User::where('username',$upazila_admin_match)->first();
        return ['district_admin'=>$district_admin,'upazila_admin'=>$upazila_admin];

    }
    public function clear(){
        \Artisan::call('cache:clear');
        \Artisan::call('config:clear');
        \Artisan::call('config:cache');
        \Artisan::call('view:clear');
        \Artisan::call('route:cache');
        \Artisan::call('route:clear');
        \Artisan::call('optimize:clear');
        return "Cleared!";
    }

}
