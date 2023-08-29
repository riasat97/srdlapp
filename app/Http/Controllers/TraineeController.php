<?php

namespace App\Http\Controllers;

use App\DataTables\TraineesDataTable;
use App\Http\Requests\CreateTraineesRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Application;
use App\Models\Bangladesh;
use App\Models\Batch;
use App\Models\Lab;
use App\Models\Trainee;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $trainerList= User::whereBetween('id',[1170,1178])->pluck('username','id');
        $select= ['0' => 'সকল'];
        $trainerList= $select+ $trainerList->toArray();
        //dd($trainerList);
        if (!empty($user) && $user->hasRole(['trainer'])) {

            $divisions_en=explode(',',$user->posting_type);
            $divisions_bn=$this->getDivisionBn($divisions_en);
            $divisionList=array_merge(['-1' => 'নির্বাচন করুন'], $divisions_bn);
            return $dataTable->render('trainees.index',['lab'=>$lab,'divisionList'=>$divisionList,'upazilas'=>$upazilas,
                'district_bn'=>$this->getDistrictBnNameByUser(),'phase'=>$phase]);
        }
        return $dataTable->render('trainees.index',['lab'=>$lab,'divisionList'=>$divisionList,'upazilas'=>$upazilas,
            'district_bn'=>$this->getDistrictBnNameByUser(),'phase'=>$phase, 'trainerList'=>$trainerList]);
    }
    public function edit($labId)
    {
        $lab= Lab::where('id',$labId)->first();
        if( !Auth::user()->hasRole('super admin') && !$lab->updated){
            Flash::warning('০৪জন প্রশিক্ষণার্থীদের তালিকা তৈরির পূর্বে ল্যাবটির তথ্য হালনাগাদ করতে হবে।');
            return redirect()->route('web.labs.edit',$labId);
        }
        if( !Auth::user()->hasAnyRole(['super admin','upazila admin','district admin']) or !permitted($lab))
            return abort(403);
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
        //dd($requestData);
        if($lab->trainees->isEmpty()){
            $trainees=$this->createTrainees($requestData,$labId);
            Flash::success('প্রশিক্ষণার্থীদের তালিকা সফল ভাবে নিবন্ধিত হয়েছে।');
        }
        else{
            $trainees=$this->updateTrainees($lab,$requestData);
            Flash::success('প্রশিক্ষণার্থীদের তালিকা সফল ভাবে আপডেট করা হয়েছে।');
        }
        return redirect()->route('web.selected-labs');
    }
    public function updateTrainee($traineeId,Request $request){
        $trainee= Trainee::find($traineeId);
        $user=Auth::user();
        $batch= $request->batch;
        $batchCount= Trainee::where('batch',$batch)->whereHas('lab', function ($data) use ($user) {
            $data->where('labs.user_id',$user->id );
        })->count();
        $batchExists= Trainee::where('batch',$batch)->whereHas('lab', function ($data) use ($user) {
            $data->where('labs.user_id',$user->id );
        })->count();
        if(!$batch){
            return response()->json(['information'=>'please input batch number']);
        }
        if(!$batchExists){
            return response()->json(['status'=>'modal','batch_id'=>$batch,'trainee_id'=>$traineeId]);
        }
        if($batchCount>=20){
            $id=($trainee->batch)?'':$traineeId;
            return response()->json(['information'=>'Maximum 20 trainees per batch','status'=>"Batch-$batch: $batchCount/20",'action'=>true,
                'batch_id'=>$batch,'trainee_id'=>$id]);
        }
        if(!empty($batch)){
            $trainee->batch=$batch;
            $trainee->save();
        }
        $batchCount= Trainee::where('batch',$batch)->whereHas('lab', function ($data) use ($user) {
            $data->where('labs.user_id',$user->id );
        })->count();
        return response()->json(['trainee'=>$trainee,
            'information'=>'Batch updated successfully...<a href="#" onclick="openModal()">Update Batch Start Date</a>',
            'status'=>"Batch-$batch: $batchCount/20",'trainee_id'=>$traineeId]);
    }
    public function postBatchDate(Request $request){
        $user= Auth::user();
        $batch= $request->batch_id;
        $batchObj= new Batch();
        $batchObj->batch= $batch;
        $batchObj->batch_start_date= $request->batch_start_date;
        $batchObj->user_id= $user->id;
        $batchObj->save();
        $trainee= Trainee::find($request->trainee_id);
        if(!empty($trainee) && !empty($batch)){
            $trainee->batch=$batch;
            $trainee->save();
        }
        $batchCount= Trainee::where('batch',$batch)->whereHas('lab', function ($data) use ($user) {
            $data->where('labs.user_id',$user->id );
        })->count();
        return response()->json(['trainee'=>$trainee,'information'=>'batch updated successfully','status'=>"Batch-$batch: $batchCount/20"]);
    }
    private function createTrainees($requestData,$labId){
        $trainees=[];
        for ($i=0;$i<4;$i++) {
            $traineeData=[
                'lab_id'=>  $labId,
                'name'=>  $requestData['name'][$i],
                'name_en'=>  $requestData['name_en'][$i],
                'designation'=>  $requestData['designation'][$i],
                'dob'=>  $requestData['dob'][$i],
                'gender'=>  $requestData['gender'][$i],
                'qualification'=>  $requestData['qualification'][$i],
                'subject'=>  $requestData['subject'][$i],
                'email'=>  $requestData['email'][$i],
                'mobile'=>  $requestData['mobile'][$i],
                'nid'=>  $requestData['nid'][$i],
                'training_title'=>  !empty($requestData['training_title'][$i])?$requestData['training_title'][$i]:null,
                'training_duration'=>  !empty($requestData['training_duration'][$i])?$requestData['training_duration'][$i]:null,
                'created_at'=>Carbon::now()->toDateTimeString()
            ];
            $trainees[]=$traineeData;
        }
        $trainees=Trainee::insert($trainees);
        $lab= Lab::where('id',$labId)->first();
        //dd($lab->trainees);
        return $lab->trainees;
    }
    private function updateTrainees($lab,$requestData){
        $trainees= $lab->trainees;
        foreach ($trainees as $i=>$trainee){
        $trainee->name= $requestData['name'][$i];
        $trainee->name_en= $requestData['name_en'][$i];
        $trainee->designation= $requestData['designation'][$i];
        $trainee->dob= $requestData['dob'][$i];
        $trainee->gender= $requestData['gender'][$i];
        $trainee->qualification= $requestData['qualification'][$i];
        $trainee->subject= $requestData['subject'][$i];
        $trainee->email= $requestData['email'][$i];
        $trainee->mobile= $requestData['mobile'][$i];
        $trainee->nid= $requestData['nid'][$i];
        $trainee->training_title= !empty($requestData['training_title'][$i])?$requestData['training_title'][$i]:null;
        $trainee->training_duration= !empty($requestData['training_duration'][$i])?$requestData['training_duration'][$i]:null;
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
