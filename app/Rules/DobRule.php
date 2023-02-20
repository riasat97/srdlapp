<?php

namespace App\Rules;

use Carbon\Carbon;
use Carbon\Traits\Creator;
use Illuminate\Contracts\Validation\Rule;

class DobRule implements Rule
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
        $date= Carbon::parse($value);
        $dt = new Carbon();
        $before = $dt->subYears(21)->format('Y-m-d');
        $dt = new Carbon();
        $after = $dt->subYears(59)->format('Y-m-d');
        return ($date->lte($before) && $date->gte($after));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $dt = new Carbon();
        $before = $dt->subYears(21)->format('Y-m-d');
        $dt = new Carbon();
        $after = $dt->subYears(59)->format('Y-m-d');
        return "The :attribute must be between ".$after." to ".$before.".";
    }
}
