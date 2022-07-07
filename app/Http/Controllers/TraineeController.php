<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Application;
use App\Models\Trainee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TraineeController extends Controller
{

    public function edit($id)
    {
        $application= Application::where('id',$id)->with('attachment','lab','verification','profile')->first();
        if( !Auth::user()->hasAnyRole(['super admin','upazila admin']) or !permitted($application))
            return abort(404);
        return view('trainees.edit',['institution'=>$application]);
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id,Request $request)
    {
        dd($request->all());
        $trainee= new Trainee();

        if (Auth::user()->hasRole(['super admin'])){
            $user = $this->userRepository->update($request->all(), $id);
            Flash::success('User updated successfully.');
            return redirect(route('users.index'));
        }
        elseif (Auth::user()->id == $id){
            $user = $this->userRepository->update($request->all(), $id);
            Flash::success('User updated successfully.');
            return redirect(route('users.edit',['id'=>$id]));
        }
        else  return abort(404);
    }
}
