<?php

namespace App\Http\Requests;

use App\Rules\MatchOldPassword;
use Illuminate\Foundation\Http\FormRequest;

class CreateChangePasswordRequest extends FormRequest
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
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => 'required|string|min:6|different:current_password',
            'new_confirm_password' => ['same:new_password'],
        ];
    }
    public function messages()
    {
        return [
            'current_password.required' => 'বর্তমান পাসওয়ার্ড অবশ্যক!',
            'new_password.required' => 'নতুন পাসওয়ার্ড অবশ্যক!',
            'new_password.different' => 'বর্তমান পাসওয়ার্ডটি আপনার নতুন পাসওয়ার্ডের মতো হওয়া যাবে না। দয়া করে একটি আলাদা পাসওয়ার্ড নির্বাচন করুন।',
            'new_confirm_password.same' => 'নতুন পাসওয়ার্ডটি অবশ্যই পুনরায় লিখা নতুন পাসওয়ার্ডের সাথে মিলতে হবে !',
        ];
    }
}
