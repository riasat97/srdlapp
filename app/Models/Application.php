<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Application extends Model
{
    use \Spatie\Tags\HasTags;
    protected $guarded = [];

    public function getLabTypeAttribute($value)
    {
        $labTypeArr= lab_type();
        return $labTypeArr[$value];
    }
    public function getInstitutionTypeAttribute($value)
    {
        $InstitutionTypeArr= institution_type();
        return $InstitutionTypeArr[$value];
    }

    public function scopePermitted($query, $type)
    {
        $user=Auth::user();
        if($user->hasRole('super admin'))
            return $query;
        if($user->hasRole('district admin')){
            $district_en=explode('_',$user->username)[0];
            $district=Bangladesh::where('district_en',$district_en)->first()->district;
            return $query->where('district',$district);
        }
        if($user->hasRole('upazila admin')){
            $upazila_en_domain=explode('_',$user->username)[0];
            $district_en=explode('_',$user->username)[1];
            $upazila=Bangladesh::where('district_en',$district_en)->where('upazila_en_domain',$upazila_en_domain)->first()->upazila;
            $district=Bangladesh::where('district_en',$district_en)->first()->district;
            return $query->where('district',$district)->where('upazila',$upazila);
        }
        return $query;
    }

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
