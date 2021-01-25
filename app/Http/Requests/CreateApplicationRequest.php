<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
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
        //dd($request->get('union_others'));
        //dd($request->all());
        //dd(gettype($request->get('institution')));
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
            //'eiin' => Rule::requiredIf($request->get('lab_type') == 'sof'),
            //'mpo' => Rule::requiredIf($request->get('lab_type') == 'sof'),
            //'ict_teacher' => Rule::requiredIf($request->get('lab_type') == 'sof'),
            //'internet_connection' => Rule::requiredIf($request->get('lab_type') == 'sof'),
            //'internet_connection_type' => Rule::requiredIf($request->get('lab_type') == 'sof' && $request->get('internet_connection_type') != 'broadband'),
            'ref_documents_file' => 'mimes:pdf|max:4000',
            'old_application_attachment' => 'mimes:pdf|max:4000',
        ];
        if ($request->isMethod('post')) {
            $list_attachment_file= ['list_attachment_file' => 'required_if:listed_by_deo,on|mimes:pdf|max:4000'];
            $rules= array_merge($rules,$list_attachment_file);
        }
        elseif($request->hasFile('list_attachment_file')){
            $list_attachment_file= ['list_attachment_file' => 'required_if:listed_by_deo,on|mimes:pdf|max:4000'];
            $rules= array_merge($rules,$list_attachment_file);
        }
        return $rules;

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
            'parliamentary_constituency.required' => 'নির্বাচনী এলাকার নাম অবশ্যক!',
            'member_name.required' => 'মাননীয় সংসদ সদস্যের নাম অবশ্যক!',
            'list_attachment_file.required_if' => 'প্রেরিত তালিকার স্ক্যান কপি (পিডিএফ) সংযুক্ত করতে হবে '
        ];
    }
}
