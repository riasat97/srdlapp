<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Nid implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $no_of_digits= $this->count_digit($value);
        return ($no_of_digits == 10 or $no_of_digits==13 or $no_of_digits==17);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be 10, 13 or 17 digits';
    }
    function count_digit($number) {
        return strlen($number);
    }
}
