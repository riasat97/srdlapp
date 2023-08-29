<?php

namespace App\Http\Controllers;

use App\DataTables\OwnLabsDataTable;
use App\Http\Requests\CreateApplicationRequest;
use App\Http\Requests\UpdateLabRequest;
use App\Models\Application;
use App\Models\Bangladesh;
use App\Models\Lab;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laracasts\Flash\Flash;

class LabController extends Controller
{
    public function ownLabs(OwnLabsDataTable $dataTable,Request $request)
    {
        dd(Hash::make('12345678'));

        if(empty(Auth::user()->mobile) && !Auth::user()->hasRole(['super admin'])){
            Flash::warning('আপনার আওতাধীন লাবসমূহ দেখার পূর্বে নিজ প্রোফাইল তৈরি করতে হবে!!!');
            return redirect(route('users.edit',['id'=>Auth::user()->id]));
        }
//        if(!Auth::user()->hasRole(['super admin']))
//        dd('please check tomorrow morning');
        $divisionList=[];
        $divisions = Bangladesh::distinct()->get("division")->toArray();
        foreach ($divisions as $key=>$division)
            $divisionList[$division['division']]=$division['division'];
        $divisionList=array_merge(['-1' => 'নির্বাচন করুন'], $divisionList);
        $user=Auth::user();
        if(!empty($user) && $user->hasRole(['vendor','trainer'])){
            $divisions_en=explode(',',$user->posting_type);
            $divisions_bn=$this->getDivisionBn($divisions_en);
            $divisionList=array_merge(['-1' => 'নির্বাচন করুন'], $divisions_bn);
        }
        $parliamentaryConstituencyList= $this->getParliamentaryConstituency($request);
        $upazilas= $this->getUpazilas($request);
        $phase= array_merge(['-1' => 'নির্বাচন করুন'],[1=>'১ম',2=>'২য়']);
        return $dataTable->render('labs.selectedLabs',['divisionList'=>$divisionList,
            'parliamentaryConstituencyList'=>$parliamentaryConstituencyList,'upazilas'=>$upazilas,
            'district_bn'=>$this->getDistrictBnNameByUser(),'phase'=>$phase]);
    }
    public function edit($id){
        $lab= Lab::where('id',$id)->first();
        if( !Auth::user()->hasAnyRole(['super admin','upazila admin','district admin']) or !permitted($lab))
            return abort(404);
        $divisionList=[];
        $divisions = Bangladesh::distinct()->get("division")->toArray();
        foreach ($divisions as $key=>$division)
            $divisionList[$division['division']]=$division['division'];
        $divisionList=array_merge(['-1' => 'নির্বাচন করুন'], $divisionList);
        $districtList= array_merge(['-1' => 'নির্বাচন করুন'],Bangladesh::where("division",$lab->division)->groupBy('district')->pluck('district','district')->toArray());
        $upazilaList= array_merge(['-1' => 'নির্বাচন করুন'],Bangladesh::where("district",$lab->district)->groupBy('upazila')->pluck('upazila','upazila')->toArray());
        $unionPourashavaWardList= array_merge(['-1' => 'নির্বাচন করুন'],Bangladesh::where("district",$lab->district)->where("upazila",$lab->upazila)->pluck('union_pourashava_ward','union_pourashava_ward')->toArray());
        $unionPourashavaWardList= Arr::add($unionPourashavaWardList, 'অন্যান্য', 'অন্যান্য');

        $ins_type= array_merge(['-1' => 'নির্বাচন করুন'], Arr::except(ins_type(),[""]));
        $ins_level= array_merge(['-1' => 'নির্বাচন করুন'], Arr::only(ins_level(), array('primary','junior_secondary','secondary','higher_secondary','secondary_and_higher',"graduation","others")));
        $ins_type_sof= array_merge(['-1' => 'নির্বাচন করুন'], Arr::only($ins_type, array('general')));
        $ins_level_sof= $array = array_merge(['-1' => 'নির্বাচন করুন'],Arr::only(ins_level(), array('secondary', 'secondary_and_higher')));

        $ins_level_technical= $array = array_merge(['-1' => 'নির্বাচন করুন'],Arr::only(ins_level(), array('junior_secondary','secondary','higher_secondary','secondary_and_higher',"diploma","others")));
        $phase= array_merge(['-1' => 'নির্বাচন করুন'],[1=>'১ম',2=>'২য়']);
        return view('labs.edit',['lab'=>$lab,
            'divisionList'=>$divisionList,'districtList'=>$districtList,'upazilaList'=>$upazilaList,'unionPourashavaWardList'=>$unionPourashavaWardList,
            "ins_type"=>$ins_type,"ins_level"=>$ins_level,"ins_type_sof"=>$ins_type_sof,"ins_level_sof"=>$ins_level_sof,
            "ins_level_technical"=>$ins_level_technical,'phase'=>$phase
            ]);
    }
    public function update($id,UpdateLabRequest $request){
        $lab= Lab::where('id',$id)->first();
        $user=Auth::user();
        if(empty($user) or !$user->hasAnyRole(['super admin','upazila admin','district admin']) or !permitted($lab))
            return abort(403);
        $lab = [
            'institution_type' => $request->get('institution_type'),
            'institution_level' => !empty($request->get('institution_level'))?$request->get('institution_level'):'',
            'union_pourashava_ward' => !empty($request->get('union_pourashava_ward'))?$request->get('union_pourashava_ward'):'',
            'parliamentary_constituency' => !empty($request->get('parliamentary_constituency'))?$request->get('parliamentary_constituency'):'',
            'seat_no' => !empty($request->get('parliamentary_constituency'))?$this->getSeatNo($request->get('parliamentary_constituency')):'',
            'is_parliamentary_constituency_ok' => (!empty($request->get('is_parliamentary_constituency_ok'))&&!empty($request->get('parliamentary_constituency')))?"YES":"",
        ];
        if(!empty(Auth::user()->hasRole('super admin'))){
            $su_lab = ['division' => $request->get('division'), 'district' => $request->get('district'),
                'upazila' => $request->get('upazila'), 'lab_type' => $request->get('lab_type'),
                'phase'=>$request->get('phase'), 'institution' => $request->get('institution'),
                'seat_type' => $request->get('seat_type')??''];
            $lab = array_merge($lab, $su_lab);
        }
        $updated= Lab::where('id',$id)->update($lab);
        $lab= Lab::where('id',$id)->first();
        if(Auth::user()->hasRole('super admin') && $request->get('hidden_is_parliamentary_constituency_ok')=="NO" && !empty($request->get('parliamentary_constituency'))){
            $lab->is_parliamentary_constituency_ok= "NO";
        }

        $lab->eiin= !empty($request->get('eiin'))?$request->get('eiin'):0;
        $lab->institution_corrected= (!empty($request->get('is_institution_bn_correction_needed'))&&!empty($request->get('institution_corrected')))?$request->get('institution_corrected'):'';
        $lab->institution_en= !empty($request->get('institution_en'))?$request->get('institution_en'):'';
        $lab->union_others= (!empty($request->get('union_pourashava_ward')=="অন্যান্য")&&!empty($request->get('union_others')))?$request->get('union_others'):'';
        $lab->ward= !empty($request->get('ward'))?$request->get('ward'):null;

        $lab->head_name= !empty($request->get('head_name'))?$request->get('head_name'):'';
        $lab->institution_email= !empty($request->get('institution_email'))?$request->get('institution_email'):'';
        $lab->institution_tel= !empty($request->get('institution_tel'))?$request->get('institution_tel'):'';
        $lab->alt_tel= !empty($request->get('alt_tel'))?$request->get('alt_tel'):'';


        $lab->total_boys= !empty($request->get('total_boys'))?$request->get('total_boys'):0;
        $lab->total_girls= !empty($request->get('total_girls'))?$request->get('total_girls'):0;
        $lab->total_teachers= !empty($request->get('total_teachers'))?$request->get('total_teachers'):0;

        $lab->latitude= !empty($request->get('latitude'))?$request->get('latitude'):null;
        $lab->longitude= !empty($request->get('longitude'))?$request->get('longitude'):null;
        if(!$user->hasRole('super admin'))
        $lab->updated= 1;
        $lab->save();

        Flash::success('ল্যাবটি সফলভাবে আপডেট করা হয়েছে।');
        return redirect()->route('web.selected-labs');
    }
    public function getParliamentaryConstituency(Request $request)
    {
        // dd($request->all());
        //$user=Auth::user();
        //if($user->hasRole(['district admin','upazila admin'])){
        $parliament = Bangladesh::groupBy('parliamentary_constituency')
            ->orderBy('seat_no_en','asc')
            ->pluck('parliamentary_constituency','parliamentary_constituency');
        $parliament=array_merge(['-1' => 'নির্বাচন করুন'], $parliament->toArray());
        return $parliament;
        // }

    }
    public function getUpazilas(Request $request)
    {
        // dd($request->all());
        $user=Auth::user();
        if($user->hasRole(['district admin'])){
            $upazilas = Bangladesh::permitted(null)
                ->groupBy('upazila')
                ->orderBy('upazila','asc')
                ->pluck('upazila','upazila');
            $select= ['1' => 'সকল'];
            $upazilas= $select+ $upazilas->toArray();
            return $upazilas;
        }
        return [];
    }
    private function getDistrictBnNameByUser()
    {
        if(Auth::user()->hasRole('district admin')){
            $district_en=strtolower(explode('_',Auth::user()->username)[0]);
            $districtobj= Bangladesh::where('district_en',$district_en)->first();
            return $districtobj->district;
        }
        return  false;
    }
    private function getSeatNo($parliamentary_constituency){
        //dd($parliamentary_constituency);
        $bd=Bangladesh::where('parliamentary_constituency',$parliamentary_constituency)->first();
        if(!empty($bd))
            return $bd->seat_no;
        else{
            $reserved_seats=ReservedSeats();
            foreach ($reserved_seats as $key=>$reserved_seat){
                if($reserved_seat['parliamentary_constituency']== $parliamentary_constituency){
                    return $reserved_seat['seat_no'];
                }
            }
            return "";
        }
    }
    private function getDivisionBn(array $divisions_en)
    {
        $division_bn=[];
        foreach ( $divisions_en as $division_en){
            $division_bn[divisionEnToBn()[$division_en]]=divisionEnToBn()[$division_en];
        }
        return $division_bn;
    }
}
