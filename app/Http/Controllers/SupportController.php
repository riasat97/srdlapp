<?php

namespace App\Http\Controllers;

use App\DataTables\StockDataTable;
use App\DataTables\TicketDataTable;
use App\Http\Requests\CreateSupportRequest;
use App\Models\Bangladesh;
use App\Models\Device;
use App\Models\Lab;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class SupportController extends Controller
{
    public function supports($labId){
        $lab= Lab::where('id',$labId)->first();
        return view('supports.support',['lab'=>$lab]);
    }
    public function ticket($ticketId,Request $request){
        $ticket= Device::where('lab_id',$request->get('lab_id'))->where('id',$ticketId)->with('lab')->first();
        return response()->json(['ticket'=>$ticket]);
    }
    public function tickets(TicketDataTable $dataTable,Request $request){
        $lab= Lab::where('id',$request->get('lab_id'))->first();
        $divisionList=[];
        $divisions = Bangladesh::distinct()->get("division")->toArray();
        foreach ($divisions as $key=>$division)
            $divisionList[$division['division']]=$division['division'];
        $divisionList=array_merge(['-1' => 'নির্বাচন করুন'], $divisionList);
        $upazilas= $this->getUpazilas($request);
        return $dataTable->render('supports.ticket',['lab'=>$lab,'divisionList'=>$divisionList,'upazilas'=>$upazilas,
            'district_bn'=>$this->getDistrictBnNameByUser()]);
    }
    public function store($labId, CreateSupportRequest $request){
        $details = ['device' => $request->device, 'device_status' => $request->device_status,'quantity' => $request->quantity,
            'problem' => $request->problem];

        $lab= Lab::where('id',$labId)->first();
        $device= !empty($request->update_id)? $this->getDevice($request->update_id):new Device();
        $device->device= $details['device'];
        $device->lab_id=$labId;
        $device->device_status= $details['device_status'];
        $device->quantity= $details['quantity'];
        $device->problem= $details['problem'];
        $device=$this->uploadAttachment($request,$device,$lab);
        $device->support_status= 'open';
        $device->save();
        $status= !empty($request->update_id)? 'updated':'created';
        return response()->json(['device'=>$device,'status'=>$status]);
    }
    protected function uploadAttachment(Request $req,$device,$lab)
    {
        if(empty($req->file("attachment_file"))) return $device;
        if(!empty($req->hasFile("attachment_file")))
            $appFilePath= "attachment_file_path";
        $file= $req->file("attachment_file");
        if(!empty($device->$appFilePath) &&!filter_var($device->$appFilePath, FILTER_VALIDATE_URL) ){
            Storage::delete($device->$appFilePath);
        }
//        $division= $lab->division;
//        $district= $lab->district;
//        $upazila=  $lab->upazila;
        //$institution= $lab->institution;
        $path= 'supports';
        $this->mkDirectoryIfNotExists($path);
        $fileName = $lab->id.'_'.date('YmdHis').'.'.$file->getClientOriginalExtension();
        $filePath = $req->file('attachment_file')->storeAs($path, $fileName, 'public');
        $device->attachment_file = $fileName;
        $device->$appFilePath = $filePath;
        return $device;

    }
    public function mkDirectoryIfNotExists($path){
        if(!Storage::exists($path)) {
            Storage::makeDirectory($path, 0775, true); //creates directory
        }
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

    private function getDevice($update_id)
    {
        return Device::find($update_id);
    }
    public function displayImage($filename)
    {
        $path = Storage::path('supports/'.$filename);
        //dd($path);
//        if (!Storage::exists($path)) {
//            abort(404);
//        }
        //$file = File::get($path);
        $type = File::mimeType($path);

         return response(file_get_contents($path),200)
        ->header('Content-Type',$type);
    }
}
