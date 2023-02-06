<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CreateSupportRequest extends FormRequest
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
        if(!empty($request->ticket_id)){
            if(Auth::user()->hasRole(['vendor','super admin']) ){
                $rules= [
                    'support_status' => 'required|string|min:2',
                ];
                return $rules;
            }
        }
        if(Auth::user()->hasRole(['super admin','district admin','upazila admin']) ){
            $rules= [
                'device_status' => 'required|string|min:2',
                'quantity' => 'required|numeric',
                'problem' => 'required|string|min:3|max:255',
                'device' => 'required|string|min:2',
            ];
            if ($request->hasFile('attachment_file')) {
                $attachment_file= ['attachment_file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:600'];
                $rules= array_merge($rules,$attachment_file);
            }
            return $rules;
        }
    }

    public function messages()
    {
        return [
            'problem.required' => 'Problem Description Required',
        ];
    }
}
