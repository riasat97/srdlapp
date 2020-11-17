<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateApplicationRequest;
use App\Models\Application;
use App\Models\ApplicationAttachment;
use App\Models\ApplicationLab;
use App\Models\ApplicationProfile;
use App\Models\ApplicationVerification;
use App\Models\Bangladesh;
use Illuminate\Http\Request;

class ApplicationUpdateController extends ApplicationController
{
    public function edit($id){

        $application= Application::where('id',$id)->with('attachment','lab','verification','profile')->first();
        $listAttachmentFile= $this->getListAttachmentFile($application);
        $listAttachmentFilePathType=$this->getListAttachmentFilePathType($application);
        //dd($application->toArray());

        $labs=[];
        $tag= new \Spatie\Tags\Tag;
        $tags=\Spatie\Tags\Tag::all();
        foreach ($tags as $tag) {
            $labs[$tag->name]=$tag->translate('name', 'bn');
        }
        $divisionList=[];
        $divisions = Bangladesh::distinct()->get("division")->toArray();
        foreach ($divisions as $key=>$division)
            $divisionList[$division['division']]=$division['division'];
        $divisionList=array_merge(['-1' => 'নির্বাচন করুন'], $divisionList);
        //dd(filter_var($application->attachment->list_attachment_file_path, FILTER_VALIDATE_URL));
        return view('applications.edit',['application'=>$application,'listAttachmentFile'=>$listAttachmentFile,
            'listAttachmentFilePathType'=>$listAttachmentFilePathType,
            'labs'=>$labs,'selectedLabs'=>$this->getLabs($application,'lab'),'divisionList'=>$divisionList]);
    }
    public function updates($id,CreateApplicationRequest $request){
        //dd($request->all());

        $application = [
            'lab_type' => $request->get('lab_type'),
            'institution_type' => $request->get('institution_type'),
            'institution_bn' => $request->get('institution_bn'),
            'division' => $request->get('division'),
            'district' => $request->get('district'),
            'upazila' => $request->get('upazila'),
            'union_pourashava_ward' => !empty($request->get('union_pourashava_ward'))?$request->get('union_pourashava_ward'):'',
            'seat_type' => $request->get('seat_type'),
            'parliamentary_constituency' => !empty($request->get('parliamentary_constituency'))?$request->get('parliamentary_constituency'):'',
            'seat_no' => !empty($request->get('parliamentary_constituency'))?$this->getSeatNo($request->get('parliamentary_constituency')):'',
            'is_parliamentary_constituency_ok' => (!empty($request->get('is_parliamentary_constituency_ok'))&&!empty($request->get('parliamentary_constituency')))?"YES":"",
            'listed_by_deo' => ($request->get('hidden_listed_by_deo')=="YES")?"YES":"NO",
        ];
        $updated= Application::where('id',$id)->update($application);
        $application= Application::where('id',$id)->with('attachment','lab','verification','profile')->first();
        //dd($application);
        if(($request->get('hidden_is_parliamentary_constituency_ok')=="NO") && !empty($request->get('parliamentary_constituency'))){
            $application->is_parliamentary_constituency_ok= "NO";
        }
        $attachment= $application->attachment;

        if($request->hasFile('list_attachment_file')){
            $attachment->member_name= !empty($request->get('member_name'))?$request->get('member_name'):'';
            $attachment=$this->fileUpload($request,$request->file("list_attachment_file"),$attachment,'list_attachment_file');
            $application->attachment()->save($attachment);
        }
        //exit;
        if($request->get('hidden_listed_by_deo')=="NO"){
            $profile= $application->profile;
            $profile->eiin= !empty($request->get('eiin'))?$request->get('eiin'):'';
            $profile->institution= !empty($request->get('institution'))?$request->get('institution'):'';
            $profile->head_name= !empty($request->get('head_name'))?$request->get('head_name'):'';
            $profile->institution_email= !empty($request->get('institution_email'))?$request->get('institution_email'):'';
            $profile->institution_tel= !empty($request->get('institution_tel'))?$request->get('institution_tel'):'';
            $profile->total_boys= !empty($request->get('total_boys'))?$request->get('total_boys'):0;
            $profile->total_girls= !empty($request->get('total_girls'))?$request->get('total_girls'):0;
            //$application->total_teachers= !empty($request->get('total_teachers'))?$request->get('total_teachers'):0;
            //$application->management= !empty($request->get('management'))?$request->get('management'):'';
            //$application->student_type= !empty($request->get('student_type'))?$request->get('student_type'):'';
            $profile->mpo= !empty($request->get('mpo'))?$request->get('mpo'):'';
            $profile->internet_connection= !empty($request->get('internet_connection'))?"YES":'';
            $profile->internet_connection_type= !empty($request->get('internet_connection_type'))?$request->get('internet_connection_type'):'';
            $profile->ict_teacher= !empty($request->get('ict_teacher'))?"YES":'';
            $profile->good_result= !empty($request->get('good_result'))?"YES":null;
            $profile->about_institution= !empty($request->get('about_institution'))?$request->get('about_institution'):'';
            $application->profile()->save($profile);
            if(!empty($request->get('labs'))){
                $applicationlabs= $application->lab;
                $applicationlabs=$this->storeLabs($request->get('labs'),$applicationlabs);
                $application->lab()->save($applicationlabs);
            }
            $verified= $application->verification;
            $verified->govlab= !empty($request->get('govlab'))?"YES":null;
            $verified->proper_infrastructure= !empty($request->get('proper_infrastructure'))?"YES":null;
            $verified->proper_room= !empty($request->get('proper_room'))?"YES":null;
            $verified->electricity_solar= !empty($request->get('electricity_solar'))?"YES":null;
            $verified->proper_security= !empty($request->get('proper_security'))?"YES":null;
            $verified->lab_maintenance= !empty($request->get('lab_maintenance'))?"YES":null;
            $verified->lab_prepared= !empty($request->get('lab_prepared'))?"YES":null;
            $verified->ict_edu= !empty($request->get('ict_edu'))?"YES":'';
            $verified->has_ict_teacher= !empty($request->get('has_ict_teacher'))?"YES":'';
            $verified->is_eiin= !empty($request->get('is_eiin'))?"YES":'';
            $verified->is_mpo= !empty($request->get('is_mpo'))?"YES":'';
            $verified->is_broadband= !empty($request->get('is_broadband'))?"YES":'';
            $application->verification()->save($verified);
            if(!empty($request->get('reference'))){
                $attachment=$this->storeReference($request,$attachment);
                $application->attachment()->save($attachment);
            }
            if(!empty($request->get('old_app'))){
                $attachment=$this->storeOldApp($request,$attachment);
                $application->attachment()->save($attachment);
            }
        }
        $application->save();
        //dd($application->toArray());
        return redirect()->route('applications.index')->with('status','আপনার আবেদনটি সফলভাবে জমা দেওয়া হয়েছে।!');
    }
    public function getListAttachmentFile(Application $application)
    {
        $list_attachment_file=$this->getListAttachmentFileIfNotExists($application->attachment);
        if(!empty($list_attachment_file)){
            if(filter_var($list_attachment_file->list_attachment_file_path, FILTER_VALIDATE_URL))
                return $list_attachment_file->list_attachment_file_path;
            elseif(!empty($list_attachment_file->list_attachment_file_path))
                return route('applications.displayPdf',['id' => $list_attachment_file->application_attachment_id,'path'=>'list_attachment_file_path']);
        }
        return  null;
    }
    private function getListAttachmentFileIfNotExists(ApplicationAttachment $attachment)
    {

        if($attachment->application->listed_by_deo =="YES" && empty($attachment->list_attachment_file_path)){
            $seat_no=$attachment->application->seat_no;
            $list_attachment_file=$attachment->whereNotNull('list_attachment_file_path')->whereHas('application', function ($query) use($seat_no) {
                $query->where('seat_no', $seat_no);
            })->first();
            //dd($list_attachment_file);
            return  $list_attachment_file;
        }
        return null;
    }
    public function getListAttachmentFilePathType(Application $application)
    {
        $list_attachment_file=$this->getListAttachmentFileIfNotExists($application->attachment);
        if(!empty($list_attachment_file)){
            if(filter_var($list_attachment_file->list_attachment_file_path, FILTER_VALIDATE_URL))
                return "প্রেরিত তালিকাটি দেখুন- google drive" ;
            elseif(!empty($list_attachment_file->list_attachment_file_path))
                return "প্রেরিত তালিকাটি দেখুন- local drive";
        }
        return  null;
    }
}
