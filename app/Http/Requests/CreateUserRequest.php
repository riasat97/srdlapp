<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class CreateUserRequest extends FormRequest
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
        $extra= ['username'=>'required|string|max:255|unique:users','role'=>'required',
                'password'=>['required', 'string', 'min:8', 'confirmed']];
        $rules= array_merge($extra,User::$rules);
        return $rules;
    }
}
