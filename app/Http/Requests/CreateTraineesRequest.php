<?php

namespace App\Http\Requests;

use App\Rules\DobRule;
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


        return [
            'name.*' => 'required|string|min:2||regex:/^[\p{Bengali}]/u',
            'designation.*' => 'required|string|min:2',
            'dob.*' => ['required','date', new DobRule],
            'gender.*' => 'required|string|min:2',
            'mobile.*' => 'required|regex:/(01)[0-9]{9}/|distinct',
            'email.*' => ['required', 'email', 'max:255'],
            'qualification.*' => 'required|string|min:2',
            'subject.*' => 'required|regex:/^[a-zA-Z]+$/u|min:2|max:50'
        ];
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
