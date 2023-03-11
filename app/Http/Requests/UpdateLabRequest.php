<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateLabRequest extends FormRequest
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
        if(Auth::user()->hasRole(['super admin']) /*&& $request->isMethod('post')*/){
            $rules= [
                'lab_type' => 'required| min:2',
                'phase' => 'required|not_in:0',
                'institution' => 'regex:/^[\p{Bengali}]/u|required',
                'institution_type' => 'required| min:2',
                'institution_corrected' => 'required_if:is_institution_bn_correction_needed,on',
                'division' => 'required| min:2',
                'district' => 'required| min:2',
                'upazila' => 'required| min:2',
                //'seat_type' => 'required| min:2',
                //'seat_type' => Rule::requiredIf(!empty($request->get('listed_by_deo'))),
                //'parliamentary_constituency' => Rule::requiredIf(!empty($request->get('listed_by_deo'))),
            ];

            return $rules;
        }
        if(Auth::user()->hasRole(['upazila admin','district admin'])){
            $rules= [
                'institution_corrected' => 'required_if:is_institution_bn_correction_needed,on|nullable|regex:/^[\p{Bengali}]/u',
                'institution_en' => 'required|regex:/^[A-Za-z0-9_! \"#$%&\'()*+,\-.\\:\/;=?@^_]+$/|min:2',
                'institution_type' => 'required|not_in:0',
                'institution_level' => 'sometimes|required|not_in:0',
                'eiin' => 'sometimes|required_if:institution_type,general,madrasha,technical| numeric',
                'total_boys' => 'required|numeric',
                'total_girls' => 'required|numeric',
                'total_teachers' => 'required|numeric',

                'head_name' => ['required','regex:/^[\p{Bengali}]/u'],
                'institution_email' => ['required','string', 'email', 'max:255'],
                'institution_tel' => 'required|regex:/(01)[0-9]{9}/',
                'alt_tel' => 'required|regex:/(01)[0-9]{9}/|different:institution_tel',

                'union_pourashava_ward' => 'required|string',
                'union_others' => 'sometimes|required_if:union_pourashava_ward,অন্যান্য',
                'ward' => 'sometimes|required|digits_between:1,100',
                'parliamentary_constituency' => 'required|string',
                'latitude' => 'numeric',
                'longitude' => 'numeric',
            ];
            return $rules;
        }
    }
    public function messages()
    {
        return [
            'lab_type.required' => 'কম্পিউটার ল্যাবের ধরণ অবশ্যক!',
            'lab_type.min' => 'কম্পিউটার ল্যাবের ধরণ অবশ্যক!',
            'phase.required' => 'পর্যায় অবশ্যক!',
            'institution.required' => 'শিক্ষা প্রতিষ্ঠানের নাম বাংলাতে অবশ্যক!',
            'institution.regex' => 'শিক্ষা প্রতিষ্ঠানের নাম বাংলাতে অবশ্যক!',
            'division.required' => 'বিভাগ অবশ্যক!',
            'division.min' => 'বিভাগ অবশ্যক!',
            'district.required' => 'জেলা অবশ্যক!',
            'upazila.required' => 'উপজেলা অবশ্যক!',

            'institution_corrected.required_if' => 'সংশোধনকৃত প্রতিষ্ঠানটির নাম অবশ্যক!',
            'institution_corrected.regex' => 'সংশোধনকৃত প্রতিষ্ঠানটির নাম বাংলায় অবশ্যক!',
            'institution_en.required' => 'প্রতিষ্ঠানটির নাম ইংরেজিতে অবশ্যক!',
            'institution_en.regex' => 'প্রতিষ্ঠানটির নাম ইংরেজিতে অবশ্যক!',
            'institution_type.required' => 'প্রতিষ্ঠানের ধরন অবশ্যক!',
            'institution_type.min' => 'প্রতিষ্ঠানের ধরন অবশ্যক!',
            'institution_type.not_in' => 'প্রতিষ্ঠানের ধরন অবশ্যক!',
            'institution_level.required' => 'প্রতিষ্ঠানের স্তর অবশ্যক!',
            'institution_level.not_in' => 'প্রতিষ্ঠানের স্তর অবশ্যক!',
            'eiin.required_if' => 'eiin অবশ্যক তবে না থাকলে ০ দিতে হবে!',
            'eiin.numeric' => 'eiin ইংলিশ ডিজিট হতে হবে!',
            'total_boys.required' => 'মোট ছাত্রের সংখ্যা অবশ্যক তবে না থাকলে ০ দিতে হবে।',
            'total_girls.required' => 'মোট ছাত্রীর সংখ্যা অবশ্যক তবে না থাকলে ০ দিতে হবে।',
            'total_teachers.required' => 'মোট শিক্ষক/শিক্ষিকার সংখ্যা অবশ্যক তবে না থাকলে ০ দিতে হবে।',
            'head_name.required' => 'প্রতিষ্ঠান প্রধানের নাম অবশ্যক এবং বাংলাতে হতে হবে!',
            'head_name.regex' => 'প্রতিষ্ঠান প্রধানের নাম বাংলাতে হতে হবে!',
            'institution_email.required' => 'প্রতিষ্ঠানের ইমেইল অবশ্যক!',
            'institution_tel.required' => 'প্রতিষ্ঠানের মোবাইল নম্বর অবশ্যক!',
            'alt_tel.required' => 'বিকল্প প্রতিষ্ঠান প্রতিনিধি/কমিটির সভাপতির মোবাইল নম্বর অবশ্যক!',
            'alt_tel.different' => 'বিকল্প মোবাইল নম্বর ভিন্ন হওয়া অবশ্যক!',

            'union_pourashava_ward.required' => 'ইউনিয়ন/পৌরসভা অবশ্যক!',
            'union_others.required' => 'ইউনিয়ন/পৌরসভা অন্যান্য নির্বাচন করলে এর নাম দেয়া অবশ্যক !',
            'union_others.regex' => 'ইউনিয়ন/পৌরসভা অন্যান্য নির্বাচন করলে এর নাম দেয়া অবশ্যক এবং বাংলাতে হতে হবে!',
            'ward.required' => 'ওয়ার্ড নং অবশ্যক!',
            'distance_from_upazila_complex.required' => 'উপজেলা পরিষদ হতে দূরত্ব (কিলোমিটার) অবশ্যক!',
            'latitude.required' => 'অক্ষাংশ (LATITUDE) অবশ্যক!',
            'longitude.required' => 'দ্রাঘিমাংশ (LONGITUDE) অবশ্যক!',
            'seat_type.required' => 'সংসদীয় আসনের ধরণ অবশ্যক!',
            'parliamentary_constituency.required' => 'নির্বাচনী এলাকার নাম অবশ্যক !',

        ];
    }
}
