<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use \Spatie\Tags\HasTags;
    protected $guarded = [];

// When a column is considered a date, you may set its value to a UNIX timestamp,
//date string (Y-m-d), date-time string, or a DateTime / Carbon instance.
//The date's value will be correctly converted and stored in your database:
// retrive $model->old_application_date->format("d-m-Y")

    public function attachment()
    {
        return $this->hasOne('App\Models\ApplicationAttachment','application_attachment_id');
    }
    public function lab()
    {
        return $this->hasOne('App\Models\ApplicationLab','application_lab_id');
    }
    public function verification()
    {
        return $this->hasOne('App\Models\ApplicationVerification','application_verification_id');
    }
    public function profile()
    {
        return $this->hasOne('App\Models\ApplicationProfile','application_profile_id');
    }

}
