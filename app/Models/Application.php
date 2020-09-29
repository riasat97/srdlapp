<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use \Spatie\Tags\HasTags;
    protected $guarded = [];
    protected $dates = [
        'old_application_date',
    ];
// When a column is considered a date, you may set its value to a UNIX timestamp,
//date string (Y-m-d), date-time string, or a DateTime / Carbon instance.
//The date's value will be correctly converted and stored in your database:
// retrive $model->old_application_date->format("d-m-Y")

}
