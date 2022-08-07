<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Application;
use App\Models\Lab;
use App\Models\Trainee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TraineeController extends Controller
{

    public function edit($labId)
    {
        $lab= Lab::where('id',$labId)->first();
        if( !Auth::user()->hasAnyRole(['super admin','upazila admin']) or !permitted($lab))
            return abort(404);
        return view('trainees.edit',['lab'=>$lab]);
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($labId,Request $request)
    {
        $lab= Lab::where('id',$labId)->first();
        $requestData = $request->all();
        if(empty($lab->trainees))
        $this->creatTrainees($requestData,$labId);
        else $this->updateTrainees($lab,$requestData);
        dd('created');
    }
    private function createTrainees($requestData,$labId){
        for ($i=0;$i<4;$i++) {
            Trainee::create([
                'lab_id'=>  $labId,
                'name'=>  $requestData['name'][$i],
                'designation'=>  $requestData['designation'][$i],
                'age'=>  $requestData['age'][$i],
                'gender'=>  $requestData['gender'][$i],
                'qualification'=>  $requestData['qualification'][$i],
                'subject'=>  $requestData['subject'][$i],
                'email'=>  $requestData['email'][$i],
                'mobile'=>  $requestData['mobile'][$i]
            ]);
        }
    }
    private function updateTrainees($lab,$requestData){
        $trainees= $lab->trainees;
        foreach ($trainees as $i=>$trainee){
        $trainee->name= $requestData['name'][$i];
        $trainee->designation= $requestData['designation'][$i];
        $trainee->age= $requestData['age'][$i];
        $trainee->gender= $requestData['gender'][$i];
        $trainee->qualification= $requestData['qualification'][$i];
        $trainee->subject= $requestData['subject'][$i];
        $trainee->email= $requestData['email'][$i];
        $trainee->mobile= $requestData['mobile'][$i];
            $lab->trainees()->save($trainee);
        }
        dd('updated');
    }
}
