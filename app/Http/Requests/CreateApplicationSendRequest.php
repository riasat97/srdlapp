<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateApplicationSendRequest extends FormRequest
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
        $user=Auth::user();
        if($user->hasRole('upazila admin')) return [];
        if($request->get('app_upazila')) return ['app_upazila'=>'sometimes|required|not_in:0'];
        else return [];
    }
    public function messages()
    {
        return [
            'app_upazila.required' => 'উপজেলা নির্বাচন করতে হবে!',
            'app_upazila.not_in' => 'উপজেলা নির্বাচন করতে হবে!',
        ];
    }
}
