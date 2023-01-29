<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
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
        if (Auth::user()->hasRole(['vendor'])){
            return ['email'=>'required', 'string', 'email', 'max:255', 'unique:users,email_address,'.$request->get('id'),'mobile' => 'required|regex:/(01)[0-9]{9}/',
            ];
        }
        $rules = User::$rules;
        $filtered = Arr::except($rules, ['email','name']);
        $add= ['email'=>'required', 'string', 'email', 'max:255', 'unique:users,email_address,'.$request->get('id'),
            'name' => 'regex:/^[\p{Bengali}]/u|required|max:100'
        ];
        //'name' => 'regex:/^[\p{Bengali}]{0,100}$/u'
        return array_merge($filtered,$add);
    }
    public function messages()
    {
        return [
            'name.required' => 'নিজের নাম বাংলায় লেখা আবশ্যক!',
            'name.regex' => 'নিজের নাম বাংলায় লেখা আবশ্যক!',
            'mobile.required' => ' মোবাইল নম্বর আবশ্যক!',
            'mobile.regex' => ' মোবাইল নম্বর অবশ্যই ইংলিশে এবং ১১ ডিজিট হবে!',
        ];
    }
}
