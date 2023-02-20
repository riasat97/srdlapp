<?php

namespace App\Http\Controllers;

use App\DataTables\TraineesDataTable;
use App\Http\Requests\CreateTraineesRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Application;
use App\Models\Bangladesh;
use App\Models\Lab;
use App\Models\Trainee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class TraineeController extends Controller
{

    public function trainees(TraineesDataTable $dataTable,Request $request){
        $lab= Lab::where('id',$request->get('lab_id'))->first();
        $divisionList=[];
        $divisions = Bangladesh::distinct()->get("division")->toArray();
        foreach ($divisions as $key=>$division)
            $divisionList[$division['division']]=$division['division'];
        $divisionList=array_merge(['-1' => 'নির্বাচন করুন'], $divisionList);
        $upazilas= $this->getUpazilas($request);
        $phase= array_merge(['-1' => 'নির্বাচন করুন'],[1=>'১ম',2=>'২য়']);
        $user=Auth::user();
        if (!empty($user) && $user->hasRole(['vendor'])) {

            $divisions_en=explode(',',$user->posting_type);
            $divisions_bn=$this->getDivisionBn($divisions_en);
            $divisionList=array_merge(['-1' => 'নির্বাচন করুন'], $divisions_bn);
            return $dataTable->render('supports.ticket',['vendor'=>$user,'divisionList'=>$divisionList,'upazilas'=>$upazilas,
                'district_bn'=>$this->getDistrictBnNameByUser()]);
        }
        return $dataTable->render('trainees.index',['lab'=>$lab,'divisionList'=>$divisionList,'upazilas'=>$upazilas,
            'district_bn'=>$this->getDistrictBnNameByUser(),'phase'=>$phase]);
    }
    public function edit($labId)
    {
        $lab= Lab::where('id',$labId)->first();
        if( !Auth::user()->hasAnyRole(['super admin','upazila admin','district admin']) or !permitted($lab))
            return abort(404);
        return view('trainees.edit',['lab'=>$lab]);
    }

    /**
     * Update the specified User in stordob.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($labId,CreateTraineesRequest $request)
    {
        $lab= Lab::where('id',$labId)->first();
        $requestData = $request->all();
        if($lab->trainees->isEmpty()){
            $trainees=$this->createTrainees($requestData,$labId);
            Flash::success('প্রশিক্ষণার্থীদের তালিকা সফল ভাবে নিবন্ধিত হয়েছে।');
        }
        else{
            $trainees=$this->updateTrainees($lab,$requestData);
            Flash::success('প্রশিক্ষণার্থীদের তালিকা সফল ভাবে আপডেট করা হয়েছে।');
        }
        return redirect()->route('labs.trainees.edit',$lab->id)->with('status','প্রশিক্ষণার্থীদের তালিকা সফল ভাবে নিবন্ধিত হয়েছে। ');
    }
    public function updateTrainee($traineeId,Request $request){
        $trainee= Trainee::find($traineeId);
        if(!empty($request->batch)){
            $trainee->batch=$request->batch;
            $trainee->save();
        }
        return response()->json(['trainee'=>$trainee,'status'=>"Batch Updated Successfully"]);
    }
    private function createTrainees($requestData,$labId){
        $trainees=[];
        for ($i=0;$i<4;$i++) {
            $trainee=Trainee::create([
                'lab_id'=>  $labId,
                'name'=>  $requestData['name'][$i],
                'designation'=>  $requestData['designation'][$i],
                'dob'=>  $requestData['dob'][$i],
                'gender'=>  $requestData['gender'][$i],
                'qualification'=>  $requestData['qualification'][$i],
                'subject'=>  $requestData['subject'][$i],
                'email'=>  $requestData['email'][$i],
                'mobile'=>  $requestData['mobile'][$i]
            ]);
            $trainees[]=$trainee;
        }
        return $trainees;
    }
    private function updateTrainees($lab,$requestData){
        $trainees= $lab->trainees;
        foreach ($trainees as $i=>$trainee){
        $trainee->name= $requestData['name'][$i];
        $trainee->designation= $requestData['designation'][$i];
        $trainee->dob= $requestData['dob'][$i];
        $trainee->gender= $requestData['gender'][$i];
        $trainee->qualification= $requestData['qualification'][$i];
        $trainee->subject= $requestData['subject'][$i];
        $trainee->email= $requestData['email'][$i];
        $trainee->mobile= $requestData['mobile'][$i];
            $lab->trainees()->save($trainee);
        }
        return $trainees;
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
    private function getDivisionBn(array $divisions_en)
    {
        $division_bn=[];
        foreach ( $divisions_en as $division_en){
            $division_bn[divisionEnToBn()[$division_en]]=divisionEnToBn()[$division_en];
        }
        return $division_bn;
    }
}
