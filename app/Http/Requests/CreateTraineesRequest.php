<?php

namespace App\Http\Requests;

use App\Rules\DobRule;
use App\Rules\Nid;
use Carbon\Carbon;
use Carbon\Traits\Creator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CreateTraineesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        //dd($request->all());
        $rules= [
            'name.*' => 'required|string|min:2||regex:/^[\p{Bengali}]/u',
            'name_en.*' => 'required|string|min:2||regex:/^[a-zA-Z\s\.\&\_\-\,\!\()]+$/u',
            //'designation'=>["required","array","min:4"],
            'designation.*' => 'required|string|min:2',
            'dob.*' => ['required','date', new DobRule],
            //'gender'=>["required","array","min:4"],
            'gender.*' => 'required|string|min:2',
            'mobile.*' => 'required|regex:/(01)[0-9]{9}/|distinct',
            'email.*' => ['required', 'email', 'max:255'],
            'nid.*' => ['required', new Nid],
            //'qualification'=>["required","array","min:4"],
            'qualification.*' => 'required|string|min:2',
            'subject.*' => 'required|regex:/^[a-zA-Z\s\.\&\_\-\,\!\()]+$/u|min:2|max:50',
            //'training_title.*' => 'sometimes|required_if:training.*,in:on|string|min:2',
            //'training_duration.*' => 'sometimes|required_if:training.*,in:on|string|min:2',
        ];
        //$trainings=$request->get('training')??[];

            //if(count($trainings)>0){
                if($request->get('hidden_ict_training1')=='yes'){
                    $rules['training_title.0'] = 'required|string|min:2';
                    $rules['training_duration.0'] = 'required|numeric';
                }
                if($request->get('hidden_ict_training2')=='yes'){
                    $rules['training_title.1'] = 'required|string|min:2';
                    $rules['training_duration.1'] = 'required|numeric';
                }
                if($request->get('hidden_ict_training3')=='yes'){
                    $rules['training_title.2'] = 'required|string|min:2';
                    $rules['training_duration.2'] = 'required|numeric';
                }
                if($request->get('hidden_ict_training4')=='yes'){
                    $rules['training_title.3'] = 'required|string|min:2';
                    $rules['training_duration.3'] = 'required|numeric';
                }
           // }

        //dd($rules);
        return  $rules;
    }
    public function messages()
    {
        return [
            'name.*' => 'প্রশিক্ষণার্থীর নাম বাংলায় অবশ্যক!',
            'name.*.regex' => 'প্রশিক্ষণার্থীর নাম বাংলায় অবশ্যক!',
            'designation.*' => 'পদবি অবশ্যক!',
            'dob.*' => 'জন্ম তারিখ অবশ্যক (ইংরেজিতে yyyy-mm-dd)!',
            'gender.*' => 'জেন্ডার অবশ্যক!',
            'gender.min' => 'select gender',
            'mobile.*' => 'মোবাইল অবশ্যক!',
            'mobile.*.distinct' => 'মোবাইল নম্বর একই হতে পারে না!',
            'email.*' => 'ইমেইল অবশ্যক!',
            'qualification.*' => 'সর্বোচ্চ শিক্ষাগত যোগ্যতা অবশ্যক!',
            'subject.*' => 'বিষয় অবশ্যক (ইংরেজিতে)!!',
            'subject.*.regex' => 'বিষয় অবশ্যক (ইংরেজিতে)!!',
            'nid.*.distinct' => 'nid নম্বর একই হতে পারে না!',
        ];
    }
}
