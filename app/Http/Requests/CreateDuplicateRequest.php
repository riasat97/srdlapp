<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CreateDuplicateRequest extends FormRequest
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
        return [
            'app_original_id' => 'required|not_in:0',
        ];
    }
    public function messages()
    {
        return [
            'app_original_id.required' => 'অরিজিনালি আবেদনকৃত প্রতিষ্ঠানটির নাম নির্বাচন করা অবশ্যক!',
            'app_original_id.not_in' => 'অরিজিনালি আবেদনকৃত প্রতিষ্ঠানটির নাম নির্বাচন করা অবশ্যক!',
        ];
    }
}
