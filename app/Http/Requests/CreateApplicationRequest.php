<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CreateApplicationRequest extends FormRequest
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
        if(Auth::user()->hasRole(['super admin']) /*&& $request->isMethod('post')*/){
            $rules= [
                'lab_type' => 'required| min:2',
                'institution_type' => 'required| min:2',
                'institution_bn' => 'required',
                'institution_corrected' => 'required_if:is_institution_bn_correction_needed,on',
                'division' => 'required| min:2',
                'district' => 'required',
                'upazila' => 'required',
                'seat_type' => Rule::requiredIf(!empty($request->get('listed_by_deo'))),
                'parliamentary_constituency' => Rule::requiredIf(!empty($request->get('listed_by_deo'))),
                'member_name' => Rule::requiredIf(!empty($request->get('listed_by_deo'))),
                'ref_type' => Rule::requiredIf(empty($request->get('listed_by_deo'))),
                'ref_name' => Rule::requiredIf(empty($request->get('listed_by_deo'))),
                'ref_designation' => Rule::requiredIf(empty($request->get('listed_by_deo'))),
                'old_application_attachment' => 'mimes:pdf|max:1000',
            ];
            if ($request->isMethod('post')) {
                $list_attachment_file= ['list_attachment_file' => 'required_if:listed_by_deo,on|mimes:pdf|max:1000',
                'ref_documents_file'=>'required_without:listed_by_deo|mimes:pdf|max:1000'];
                $rules= array_merge($rules,$list_attachment_file);
            }
            elseif($request->hasFile('list_attachment_file')){
                $list_attachment_file= ['list_attachment_file' => 'required_if:listed_by_deo,on|mimes:pdf|max:1000'];
                $rules= array_merge($rules,$list_attachment_file);
            }
            elseif($request->hasFile('ref_documents_file')){
                $ref_documents_file= ['ref_documents_file' => 'required_without:listed_by_deo|mimes:pdf|max:1000'];
                $rules= array_merge($rules,$ref_documents_file);
            }
        return $rules;
        }
        if(Auth::user()->hasRole(['district admin']) /*or $request->isMethod('put')*/){
            $rules= [
                'institution_corrected' => 'required_if:is_institution_bn_correction_needed,on|string',
                'institution' => 'required|alpha|min:2',
                'management' => 'required|not_in:0',
                'institution_type' => 'required|not_in:0',
                'institution_level' => 'sometimes|required|not_in:0',
                'eiin' => 'sometimes|required_if:institution_type,general,madrasha,technical| numeric',
                'mpo' => 'sometimes|nullable|numeric',
                'total_boys' => 'required|numeric',
                'total_girls' => 'required|numeric',
                'head_name' => ['required','string'],
                'institution_email' => ['required','string', 'email', 'max:255'],
                'institution_tel' => 'required|regex:/(01)[0-9]{9}/',
                'alt_name' => 'nullable|string',
                'alt_email' => ['nullable','string', 'email', 'max:255'],
                'alt_tel' => 'nullable|regex:/(01)[0-9]{9}/',
                'union_pourashava_ward' => 'required|string',
                'union_others' => 'sometimes|required_if:union_pourashava_ward,অন্যান্য',
                'ward' => 'sometimes|required|digits_between:1,100',
                'village_road' => 'required|string',
                'post_office' => 'required|string',
                'post_code' => 'required|numeric',
                'distance_from_upazila_complex' => 'required|numeric',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'seat_type' => 'required|string',
                'parliamentary_constituency' => 'required|string',
                'labs' => 'required_if:govlab,on|array',
                'internet_connection_type' => 'required_if:internet_connection,on|not_in:0',
                'about_institution' => 'nullable|string',
            ];
            if (!empty($request->get('labs'))&& in_array('Others', $request->input('labs', []))) {
                $rules['lab_others_title'] = 'required| string';
            }
            /*if ($request->isMethod('put')) {
                $verification_report_file= ['verification_report_file' => 'required|mimes:pdf|max:500'];
                $rules= array_merge($rules,$verification_report_file);
            }*/
            elseif($request->hasFile('verification_report_file')){
                $verification_report_file= ['verification_report_file' => 'required|mimes:pdf|max:500'];
                $rules= array_merge($rules,$verification_report_file);
            }
            return $rules;
        }


    }
    public function messages()
    {
        return [
            'lab_type.required' => 'কম্পিউটার ল্যাবের ধরণ অবশ্যক!',
            'lab_type.min' => 'কম্পিউটার ল্যাবের ধরণ অবশ্যক!',
            'institution_type.required' => 'প্রতিষ্ঠানের ধরন অবশ্যক!',
            'institution_type.min' => 'প্রতিষ্ঠানের ধরন অবশ্যক!',
            'institution_bn.required' => 'শিক্ষা প্রতিষ্ঠানের নাম বাংলাতে অবশ্যক!',
            'institution_corrected.required_if' => 'সংশোধনকৃত প্রতিষ্ঠানটির নাম অবশ্যক!',
            //'institution_bn.max' => 'শিক্ষা প্রতিষ্ঠানের নাম max:1!',
            'division.required' => 'বিভাগ অবশ্যক!',
            'division.min' => 'বিভাগ অবশ্যক!',
            'district.required' => 'জেলা অবশ্যক!',
            'upazila.required' => 'উপজেলা অবশ্যক!',
            'seat_type.required' => 'সংসদীয় আসনের ধরণ অবশ্যক!',
            'parliamentary_constituency.required' => 'নির্বাচনী এলাকার নাম অবশ্যক !',
            'member_name.required' => 'মাননীয় সংসদ সদস্যের নাম অবশ্যক!',
            'list_attachment_file.required_if' => 'প্রেরিত তালিকার স্ক্যান কপি (পিডিএফ) সংযুক্ত করতে হবে '
        ];
    }
}
