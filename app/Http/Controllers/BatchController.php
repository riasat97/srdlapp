<?php

namespace App\Http\Controllers;

use App\DataTables\TraineesDataTable;
use App\Models\Bangladesh;
use App\Models\Lab;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BatchController extends Controller
{
    public function batches(BatchDataTable $dataTable,Request $request){
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
        $select= ['1' => 'সকল'];
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
}
