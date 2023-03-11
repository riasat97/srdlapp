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
            'name_en.*' => 'required|string|min:2||regex:/^[a-zA-Z\s\.]+$/u',
            'designation.*' => 'required|string|min:2',
            'dob.*' => ['required','date', new DobRule],
            'gender.*' => 'required|string|min:2',
            'mobile.*' => 'required|regex:/(01)[0-9]{9}/|distinct',
            'email.*' => ['required', 'email', 'max:255'],
            'nid.*' => ['required', new Nid],
            'qualification.*' => 'required|string|min:2',
            'subject.*' => 'required|regex:/^[a-zA-Z]+$/u|min:2|max:50',
            //'training_title.*' => 'sometimes|required_if:training.*,in:on|string|min:2',
            //'training_duration.*' => 'sometimes|required_if:training.*,in:on|string|min:2',
        ];
        $trainings=$request->get('training')??[];
            if(count($trainings)>0){
                if(!empty($trainings[0])&&$trainings[0]=='on'){
                    $rules['training_title.0'] = 'required';
                    $rules['training_duration.0'] = 'required';
                }
                if(!empty($trainings[1])&&$trainings[1]=='on'){

                    $rules['training_title.1'] = 'required';
                    $rules['training_duration.1'] = 'required';
                }
                if(!empty($trainings[2])&&$trainings[2]=='on'){
                    $rules['training_title.2'] = 'required';
                    $rules['training_duration.2'] = 'required';
                }
                if(!empty($trainings[3])&&$trainings[3]=='on'){
                    $rules['training_title.3'] = 'required';
                    $rules['training_duration.3'] = 'required';
                }
            }

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
            'mobile.*' => 'মোবাইল অবশ্যক!',
            'mobile.*.distinct' => 'মোবাইল নম্বর একই হতে পারে না!',
            'email.*' => 'ইমেইল অবশ্যক!',
            'qualification.*' => 'সর্বোচ্চ শিক্ষাগত যোগ্যতা অবশ্যক!',
            'subject.*' => 'বিষয় অবশ্যক (ইংরেজিতে)!!',
            'subject.*.regex' => 'বিষয় অবশ্যক (ইংরেজিতে)!!',
        ];
    }
}
