<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class UpdateUserRequest extends FormRequest
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
        $rules = User::$rules;
        $filtered = Arr::except($rules, ['email']);
        $email= ['email'=>'required', 'string', 'email', 'max:255', 'unique:users,email_address,'.$request->get('id')];
        return array_merge($filtered,$email);
    }
}
