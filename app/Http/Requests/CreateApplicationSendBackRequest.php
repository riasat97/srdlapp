<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateApplicationSendBackRequest extends FormRequest
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
    public function rules()
    {
        return [
            'app_upazila'=>'required|not_in:0'
        ];
    }
    public function messages()
    {
        return [
            'app_upazila.required' => 'উপজেলা নির্বাচন করতে হবে!',
            'app_upazila.not_in' => 'উপজেলা নির্বাচন করতে হবে!',
        ];
    }
}
