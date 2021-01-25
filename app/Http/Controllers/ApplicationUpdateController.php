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
use Illuminate\Support\Arr;

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
        $districtList= array_merge(['-1' => 'নির্বাচন করুন'],Bangladesh::where("division",$application->division)->groupBy('district')->pluck('district','district')->toArray());
        $upazilaList= array_merge(['-1' => 'নির্বাচন করুন'],Bangladesh::where("district",$application->district)->groupBy('upazila')->pluck('upazila','upazila')->toArray());
        $unionPourashavaWardList= array_merge(['-1' => 'নির্বাচন করুন'],Bangladesh::where("district",$application->district)->where("upazila",$application->upazila)->pluck('union_pourashava_ward','union_pourashava_ward')->toArray());
        $unionPourashavaWardList= Arr::add($unionPourashavaWardList, 'অন্যান্য', 'অন্যান্য');
        //dd(filter_var($application->attachment->list_attachment_file_path, FILTER_VALIDATE_URL));
        $ins_type= array_merge(['-1' => 'নির্বাচন করুন'], Arr::except(ins_type(),[""]));
        $ins_level= array_merge(['-1' => 'নির্বাচন করুন'], Arr::only(ins_level(), array('primary','junior_secondary','secondary','higher_secondary','secondary_and_higher',"graduation","others")));
        $ins_type_sof= array_merge(['-1' => 'নির্বাচন করুন'], Arr::only($ins_type, array('general', 'madrasha', 'technical')));
        $ins_level_sof= $array = array_merge(['-1' => 'নির্বাচন করুন'],Arr::only(ins_level(), array('secondary', 'secondary_and_higher')));

        $ins_level_technical= $array = array_merge(['-1' => 'নির্বাচন করুন'],Arr::only(ins_level(), array('junior_secondary','secondary','higher_secondary','secondary_and_higher',"diploma","others")));

        return view('applications.edit',['application'=>$application,'listAttachmentFile'=>$listAttachmentFile,
            'listAttachmentFilePathType'=>$listAttachmentFilePathType,
            'labs'=>$labs,'selectedLabs'=>$this->getLabs($application,'lab'),
            'divisionList'=>$divisionList,'districtList'=>$districtList,'upazilaList'=>$upazilaList,'unionPourashavaWardList'=>$unionPourashavaWardList,
            "ins_type"=>$ins_type,"ins_level"=>$ins_level,"ins_type_sof"=>$ins_type_sof,"ins_level_sof"=>$ins_level_sof,
            "ins_level_technical"=>$ins_level_technical]);
    }
    public function updates($id,CreateApplicationRequest $request){
        //dd($request->all());
        $application = [
            'lab_type' => $request->get('lab_type'),
            'institution_bn' => $request->get('institution_bn'),
            'institution_type' => $request->get('institution_type'),
            'institution_level' => $request->get('institution_level'),
            'division' => $request->get('division'),
            'district' => $request->get('district'),
            'upazila' => $request->get('upazila'),
            'union_pourashava_ward' => !empty($request->get('union_pourashava_ward'))?$request->get('union_pourashava_ward'):'',
            'seat_type' => $request->get('seat_type'),
            'parliamentary_constituency' => !empty($request->get('parliamentary_constituency'))?$request->get('parliamentary_constituency'):'',
            'seat_no' => !empty($request->get('parliamentary_constituency'))?$this->getSeatNo($request->get('parliamentary_constituency')):'',
            'is_parliamentary_constituency_ok' => (!empty($request->get('is_parliamentary_constituency_ok'))&&!empty($request->get('parliamentary_constituency')))?"YES":"",
            //'listed_by_deo' => !empty($request->get('listed_by_deo'))?"YES":"NO",
        ];
        $updated= Application::where('id',$id)->update($application);
        $application= Application::where('id',$id)->with('attachment','lab','verification','profile')->first();
        //dd($application);
        if(($request->get('hidden_is_parliamentary_constituency_ok')=="NO") && !empty($request->get('parliamentary_constituency'))){
            $application->is_parliamentary_constituency_ok= "NO";
        }
        $attachment= (!empty($application->attachment))?$application->attachment : new ApplicationAttachment();
        if( empty($request->get('listed_by_deo')) && $application->listed_by_deo=="YES"){ // deo changed to ref
            $application->listed_by_deo="NO";
            $application->save();
        }
        if( !empty($request->get('listed_by_deo')) && $application->listed_by_deo=="YES" && empty($request->get('reference'))){
            $application->listed_by_deo="YES";
            $application->save();
            $attachment->member_name= !empty($request->get('member_name'))?$request->get('member_name'):'';
        if($request->hasFile('list_attachment_file')){
            $attachment=$this->fileUpload($request,$request->file("list_attachment_file"),$attachment,'list_attachment_file');
        }
        $application->attachment()->save($attachment);
        }
        //if($request->get('hidden_listed_by_deo')=="NO"){
        $profile= (!empty($application->profile))?$application->profile : new ApplicationProfile();
            $profile->eiin= !empty($request->get('eiin'))?$request->get('eiin'):'';
            $profile->institution_corrected= (!empty($request->get('is_institution_bn_correction_needed'))&&!empty($request->get('institution_corrected')))?$request->get('institution_corrected'):'';
            $profile->institution= !empty($request->get('institution'))?$request->get('institution'):'';
            $profile->union_others= (!empty($request->get('union_pourashava_ward')=="অন্যান্য")&&!empty($request->get('union_others')))?$request->get('union_others'):'';
            $profile->ward= !empty($request->get('ward'))?$request->get('ward'):'';
            $profile->village_road= !empty($request->get('village_road'))?$request->get('village_road'):'';
            $profile->post_office= !empty($request->get('post_office'))?$request->get('post_office'):'';
            $profile->post_code= !empty($request->get('post_code'))?$request->get('post_code'):'';
            $profile->distance_from_upazila_complex= !empty($request->get('distance_from_upazila_complex'))?$request->get('distance_from_upazila_complex'):'';
            $profile->direction= !empty($request->get('direction'))?$request->get('direction'):'';
            $profile->proper_road= !empty($request->get('proper_road'))?"YES":'';
            $profile->latitude= !empty($request->get('latitude'))?$request->get('latitude'):'';
            $profile->longitude= !empty($request->get('longitude'))?$request->get('longitude'):'';
            $profile->head_name= !empty($request->get('head_name'))?$request->get('head_name'):'';
            $profile->institution_email= !empty($request->get('institution_email'))?$request->get('institution_email'):'';
            $profile->institution_tel= !empty($request->get('institution_tel'))?$request->get('institution_tel'):'';
            $profile->alt_name= !empty($request->get('alt_name'))?$request->get('alt_name'):'';
            $profile->alt_tel= !empty($request->get('alt_tel'))?$request->get('alt_tel'):'';
            $profile->alt_email= !empty($request->get('alt_email'))?$request->get('alt_email'):'';
            $profile->mpo= !empty($request->get('mpo'))?$request->get('mpo'):'';
            $profile->total_boys= !empty($request->get('total_boys'))?$request->get('total_boys'):0;
            $profile->total_girls= !empty($request->get('total_girls'))?$request->get('total_girls'):0;
        $application->profile()->save($profile);

        $applicationlabs= (!empty($application->lab))?$application->lab : new ApplicationLab();
            $labs=$request->get('labs');
            $applicationlabs=empty($labs)?$this->emptyLabs($applicationlabs):$this->updateLabs($request->get('labs'),$applicationlabs);
            $applicationlabs->lab_others_title= (!empty($labs)&&in_array("Others",$request->get('labs'))&&!empty($request->get('lab_others_title')))?$request->get('lab_others_title'):'';
        $application->lab()->save($applicationlabs);

        $verified= (!empty($application->verification))?$application->verification : new ApplicationVerification();
            $verified->govlab= (!empty($request->get('govlab'))&&!empty($request->get('labs')))?"YES":null;
            $verified->proper_infrastructure= !empty($request->get('proper_infrastructure'))?"YES":null;
            $verified->proper_room= !empty($request->get('proper_room'))?"YES":null;
            $verified->electricity_solar= !empty($request->get('electricity_solar'))?"YES":null;
            $verified->proper_security= !empty($request->get('proper_security'))?"YES":null;
            $verified->lab_maintenance= !empty($request->get('lab_maintenance'))?"YES":null;
            $verified->lab_prepared= !empty($request->get('lab_prepared'))?"YES":null;

            $verified->internet_connection= !empty($request->get('internet_connection'))?"YES":'';
            $verified->internet_connection_type= !empty($request->get('internet_connection_type'))?$request->get('internet_connection_type'):'';
            $verified->good_result= !empty($request->get('good_result'))?"YES":null;
            $verified->about_institution= !empty($request->get('about_institution'))?$request->get('about_institution'):'';
            $verified->has_ict_teacher= !empty($request->get('has_ict_teacher'))?"YES":'';

            $verified->app_upazila_verified= !empty($request->get('app_upazila_verified'))?"YES":'';
            $verified->app_district_verified= !empty($request->get('app_district_verified'))?"YES":'';
            $verified->app_duplicate= !empty($request->get('app_duplicate'))?"YES":'';
        $application->verification()->save($verified);

        if(!empty($request->hasFile('verification_report_file'))){
            $attachment=$this->storeVerificationReport($request,$attachment);
            $application->attachment()->save($attachment);
        }
        if((empty($request->get('listed_by_deo')) or $application->listed_by_deo=="NO") &&!empty($request->get('reference'))){
            $attachment=$this->storeReference($request,$attachment);
            $application->attachment()->save($attachment);
        }
        if(!empty($request->get('old_app'))){
            $attachment=$this->storeOldApp($request,$attachment);
            $application->attachment()->save($attachment);
        }
        //}
        $application->save();
        //dd($application->toArray());
        return redirect()->route('applications.index')->with('status','আপনার আবেদনটি সফলভাবে জমা দেওয়া হয়েছে।!');
    }


    private function emptyLabs(ApplicationLab $applicationlabs)
    {
        $applicationlabs->lab_by_srdl= "";
        $applicationlabs->lab_by_bcc= "";
        $applicationlabs->lab_by_moe= '';
        $applicationlabs->lab_by_dshe= '';
        $applicationlabs->lab_by_edu_board= '';
        $applicationlabs->lab_by_others= '';
        $applicationlabs->lab_others_title= '';
        return $applicationlabs;
    }

    private function updateLabs($labs, ApplicationLab $applicationlabs)
    {
        $applicationlabs->lab_by_srdl= in_array("Sheikh Russel Digital Lab",$labs)?"YES":'';
        $applicationlabs->lab_by_bcc=in_array("Bangladesh Computer Council",$labs)?"YES":'';
        $applicationlabs->lab_by_moe=in_array("Ministry of Education",$labs)?"YES":'';
        $applicationlabs->lab_by_dshe=in_array("Directorate of Secondary and Higher Education",$labs)?"YES":'';
        $applicationlabs->lab_by_edu_board=in_array("Education Board",$labs)?"YES":'';
        $applicationlabs->lab_by_others=in_array("Others",$labs)?"YES":'';
        return $applicationlabs;
    }
}
