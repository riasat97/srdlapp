<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CreateDistrictVerificationRequest extends FormRequest
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
            'app_district_verified' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'app_district_verified.required' => 'জেলা প্রশাসক কর্তৃক প্রতিষ্ঠানটি যাচাই করা আবশ্যক !',
        ];
    }
}
