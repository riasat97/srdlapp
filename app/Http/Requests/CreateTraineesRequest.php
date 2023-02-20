<?php

namespace App\Http\Requests;

use App\Rules\DobRule;
use Carbon\Carbon;
use Carbon\Traits\Creator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CreateTraineesRequest extends FormRequest
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


        return [
            'name.*' => 'required|string|min:2||regex:/^[\p{Bengali}]/u',
            'designation.*' => 'required|string|min:2',
            'dob.*' => ['required','date', new DobRule],
            'gender.*' => 'required|string|min:2',
            'mobile.*' => 'required|regex:/(01)[0-9]{9}/',
            'email.*' => ['required', 'email', 'max:255'],
            'qualification.*' => 'required|string|min:2',
            'subject.*' => 'required|alpha|min:2|max:50'
        ];
    }
}
