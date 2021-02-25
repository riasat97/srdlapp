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
        //dd(in_array("0",$request->get('internet_connection_type')));
            if(Auth::user()->hasRole(['super admin']) /*&& $request->isMethod('post')*/){
            $rules= [
                'lab_type' => 'required| min:2',
                'institution_type' => 'required| min:2',
                'institution_bn' => 'regex:/^[\p{Bengali}]/u|required',
                'institution_corrected' => 'required_if:is_institution_bn_correction_needed,on',
                'division' => 'required| min:2',
                'district' => 'required',
                'upazila' => 'required',
                //'seat_type' => Rule::requiredIf(!empty($request->get('listed_by_deo'))),
                //'parliamentary_constituency' => Rule::requiredIf(!empty($request->get('listed_by_deo'))),
                'member_name' => Rule::requiredIf(!empty($request->get('listed_by_deo'))),
                'ref_type' => Rule::requiredIf(empty($request->get('listed_by_deo'))),
                'ref_name' => Rule::requiredIf(empty($request->get('listed_by_deo'))),
                'ref_designation' => Rule::requiredIf(empty($request->get('listed_by_deo'))),
                'old_application_attachment' => 'mimes:pdf|max:1000',
                //'app_upazila_verified' => 'required|in:YES,NO',

            ];
            if ($request->hasFile('list_attachment_file') or !$request->get('list_attachment')) {
                $list_attachment_file= ['list_attachment_file' => 'required_if:listed_by_deo,on|mimes:pdf|max:1000'];
                $rules= array_merge($rules,$list_attachment_file);
            }

            if($request->hasFile('ref_documents_file')  or !$request->get('ref_documents')){
                $ref_documents_file= ['ref_documents_file' => 'required_without:listed_by_deo|mimes:pdf|max:1000'];
                $rules= array_merge($rules,$ref_documents_file);
            }
        return $rules;
        }
        if(Auth::user()->hasRole(['upazila admin']) /*or $request->isMethod('put')*/){
            $rules= [
                'institution_corrected' => 'required_if:is_institution_bn_correction_needed,on|nullable|regex:/^[\p{Bengali}]/u',
                'institution' => 'required|regex:/^[A-Za-z0-9_! \"#$%&\'()*+,\-.\\:\/;=?@^_]+$/|min:2',
                'management' => 'required|not_in:0',
                'institution_type' => 'required|not_in:0',
                'institution_level' => 'sometimes|required|not_in:0',
                'eiin' => 'sometimes|required_if:institution_type,general,madrasha,technical| numeric',
                'mpo' => 'sometimes|nullable|numeric',
                'total_boys' => 'required|numeric',
                'total_girls' => 'required|numeric',
                'head_name' => ['required','regex:/^[\p{Bengali}]/u'],
                'institution_email' => ['required','string', 'email', 'max:255'],
                'institution_tel' => 'required|regex:/(01)[0-9]{9}/',
                'alt_name' => 'required|regex:/^[\p{Bengali}]/u',
                'alt_email' => ['required','string', 'email', 'max:255'],
                'alt_tel' => 'required|regex:/(01)[0-9]{9}/',
                'union_pourashava_ward' => 'required|string',
                'union_others' => 'sometimes|required_if:union_pourashava_ward,অন্যান্য',
                'ward' => 'sometimes|required|digits_between:1,100',
                'village_road' => 'required|regex:/^[\p{Bengali}]/u',
                'post_office' => 'required|regex:/^[\p{Bengali}]/u',
                'post_code' => 'required|numeric',
                'distance_from_upazila_complex' => 'required|numeric',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'seat_type' => 'sometimes|required|string',
                'parliamentary_constituency' => 'required|string',
                'labs' => 'required_if:govlab,on|array',
                'internet_connection_type' => 'required|array',
                'about_institution' => 'nullable|string|max:500',
                'app_upazila_verified' => 'required|in:YES,NO',
            ];
            if (!empty($request->get('labs'))&& in_array('Others', $request->input('labs', []))) {
                $rules['lab_others_title'] = 'required| string';
            }
            if (!empty($request->get('internet_connection_type'))&& in_array('modem', $request->input('internet_connection_type', []))) {
                $rules['mobile_operators'] = 'required| array';
            }
            if($request->hasFile('verification_report_file') or !$request->get('verification_report')){
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
            'institution_bn.required' => 'শিক্ষা প্রতিষ্ঠানের নাম বাংলাতে অবশ্যক!',
            'institution_bn.regex' => 'শিক্ষা প্রতিষ্ঠানের নাম বাংলাতে অবশ্যক!',
            'division.required' => 'বিভাগ অবশ্যক!',
            'division.min' => 'বিভাগ অবশ্যক!',
            'district.required' => 'জেলা অবশ্যক!',
            'upazila.required' => 'উপজেলা অবশ্যক!',
            'member_name.required' => 'মাননীয় সংসদ সদস্যের নাম অবশ্যক!',
            'list_attachment_file.required_if' => 'প্রেরিত তালিকার স্ক্যান কপি (পিডিএফ) সংযুক্ত করতে হবে ',
            'ref_type.required' => 'সুপারিশকারীর পরিচয় অবশ্যক!',
            'ref_name.required' => 'সুপারিশকারীর নাম অবশ্যক!',
            'ref_designation.required' => 'সুপারিশকারীর পদবী অবশ্যক!',

            'institution_corrected.required_if' => 'সংশোধনকৃত প্রতিষ্ঠানটির নাম অবশ্যক!',
            'institution_corrected.regex' => 'সংশোধনকৃত প্রতিষ্ঠানটির নাম বাংলায় অবশ্যক!',
            'institution.required' => 'প্রতিষ্ঠানটির নাম ইংরেজিতে অবশ্যক!',
            'institution.regex' => 'প্রতিষ্ঠানটির নাম ইংরেজিতে অবশ্যক!',
            'management.required' => 'ম্যানেজমেন্ট নির্বাচন অবশ্যক!',
            'management.not_in' => 'ম্যানেজমেন্ট নির্বাচন অবশ্যক!',
            'institution_type.required' => 'প্রতিষ্ঠানের ধরন অবশ্যক!',
            'institution_type.min' => 'প্রতিষ্ঠানের ধরন অবশ্যক!',
            'institution_type.not_in' => 'প্রতিষ্ঠানের ধরন অবশ্যক!',
            'institution_level.required' => 'প্রতিষ্ঠানের স্তর অবশ্যক!',
            'institution_level.not_in' => 'প্রতিষ্ঠানের স্তর অবশ্যক!',
            'eiin.required_if' => 'eiin অবশ্যক তবে না থাকলে ০ দিতে হবে!',
            'eiin.numeric' => 'eiin ইংলিশ ডিজিট হতে হবে!',
            'mpo.numeric' => 'mpo ইংলিশ ডিজিট হতে হবে!',
            'total_boys.required' => 'মোট ছাত্রের সংখ্যা অবশ্যক তবে না থাকলে ০ দিতে হবে।',
            'total_girls.required' => 'মোট ছাত্রীর সংখ্যা অবশ্যক তবে না থাকলে ০ দিতে হবে।',
            'head_name.required' => 'প্রতিষ্ঠান প্রধানের নাম অবশ্যক এবং বাংলাতে হতে হবে!',
            'head_name.regex' => 'প্রতিষ্ঠান প্রধানের নাম বাংলাতে হতে হবে!',
            'institution_email.required' => 'প্রতিষ্ঠানের ইমেইল অবশ্যক!',
            'institution_tel.required' => 'প্রতিষ্ঠানের মোবাইল নম্বর অবশ্যক!',
            'alt_name.required' => 'বিকল্প প্রতিষ্ঠান প্রতিনিধি/কমিটির সভাপতির নাম অবশ্যক এবং বাংলাতে হতে হবে!',
            'alt_name.regex' => 'বিকল্প প্রতিষ্ঠান প্রতিনিধি/কমিটির সভাপতির নাম বাংলাতে হতে হবে!',
            'alt_email.required' => 'বিকল্প প্রতিষ্ঠান প্রতিনিধি/কমিটির সভাপতির ইমেইল অবশ্যক!',
            'alt_tel.required' => 'বিকল্প প্রতিষ্ঠান প্রতিনিধি/কমিটির সভাপতির মোবাইল নম্বর অবশ্যক!',

            'union_pourashava_ward.required' => 'ইউনিয়ন/পৌরসভা অবশ্যক!',
            'union_others.required' => 'ইউনিয়ন/পৌরসভা অন্যান্য নির্বাচন করলে এর নাম দেয়া অবশ্যক !',
            'union_others.regex' => 'ইউনিয়ন/পৌরসভা অন্যান্য নির্বাচন করলে এর নাম দেয়া অবশ্যক এবং বাংলাতে হতে হবে!',
            'ward.required' => 'ওয়ার্ড নং অবশ্যক!',
            'village_road.required' => 'গ্রাম/পাড়া/মহল্লা/সড়ক অবশ্যক!',
            'village_road.regex' => 'গ্রাম/পাড়া/মহল্লা/সড়ক বাংলাতে হতে হবে!',
            'post_office.required' => 'পোস্ট অফিস অবশ্যক!',
            'post_office.regex' => 'পোস্ট অফিস বাংলাতে হতে হবে!',
            'post_code.required' => 'পোস্ট কোড অবশ্যক!',
            'distance_from_upazila_complex.required' => 'উপজেলা পরিষদ হতে দূরত্ব (কিলোমিটার) অবশ্যক!',
            'latitude.required' => 'অক্ষাংশ (LATITUDE) অবশ্যক!',
            'longitude.required' => 'দ্রাঘিমাংশ (LONGITUDE) অবশ্যক!',
            'seat_type.required' => 'সংসদীয় আসনের ধরণ অবশ্যক!',
            'parliamentary_constituency.required' => 'নির্বাচনী এলাকার নাম অবশ্যক !',
            'labs.required'=>'ইতোপূর্বে ল্যাব প্রাপ্ত হলে ল্যাবসমূহ নির্বাচন অবশ্যক !',
            'lab_others_title.required'=>'প্রাপ্ত ল্যাব সমূহের মধ্যে অন্যান্য নির্বাচন করা হলে অন্যান্য ল্যাবের নাম অবশ্যক !',
            'internet_connection_type.required' => 'ইন্টারনেট সংযোগের ধরন অবশ্যক। যদি সংযোগ না থাকে তাহলে নাই নির্বাচন করতে হবে। ',
            'mobile_operators.required'=>'ইন্টারনেট সংযোগের ধরন মডেম হলে ডাটা কানেকশনের জন্য ব্যবহৃত মোবাইল অপারেটর সমূহ নির্বাচন অবশ্যক !',
            'app_upazila_verified.required' => 'সুপারিশকারী (উপজেলা নির্বাহী অফিসার) কর্তৃক প্রতিষ্ঠানটিকে সুপারিশ করা বা না করা আবশ্যক। ',
            'verification_report_file.required' => 'প্রতিষ্ঠানটির পরিদর্শন প্রতিবেদনের স্ক্যান কপি আবশ্যক। ',
            'verification_report_file.max' => 'প্রতিষ্ঠানটির পরিদর্শন প্রতিবেদনের স্ক্যান কপি (পিডিএফ: সর্বোচ্চ ৫০০ kb)। ',
            'verification_report_file.mimes' => 'প্রতিষ্ঠানটির পরিদর্শন প্রতিবেদনের স্ক্যান কপি (পিডিএফ: সর্বোচ্চ ৫০০ kb)। ',
        ];
    }
}
