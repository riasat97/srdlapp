<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class Application extends Model
{
    use \Spatie\Tags\HasTags;
    protected $guarded = [];
    protected $appends = ['constituency','application_type','ins','contact'];
    public function getLabTypeAttribute($value)
    {
        $labTypeArr= lab_type();
        return $labTypeArr[$value];
    }

    public function getInstitutionTypeAttribute($value)
    {
        $InstitutionTypeArr= ins_type();
        return $InstitutionTypeArr[$value];
    }
    public function getInstitutionLevelAttribute($value)
    {
        $InstitutionLevelArr= ins_level();
        return $InstitutionLevelArr[$value];
    }
    public function getConstituencyAttribute()
    {
         return "{$this->seat_no} {$this->parliamentary_constituency}";
    }
    public function getContactAttribute()
    {
        return empty($this->profile)?0:$this->profile->tel;
    }
    private function getLabId(Application $application)
    {
        if($application->lab_type=="শেখ রাসেল ডিজিটাল ল্যাব")return $application->id;
        if($application->lab_type=="স্কুল অফ ফিউচার")return $application->id." (SOF)";
        if($application->lab_type=="স্কুল অফ ফিউচার ও শেখ রাসেল ডিজিটাল ল্যাব")return $this->id." (SOF & SRDL)";

    }
    public function getInsAttribute()
    {
        $labId=$this->getLabId($this);
        return (!empty($this->profile) && !empty($this->profile->institution_corrected))?
            $this->profile->institution_corrected."-".$labId:$this->institution_bn."-".$labId;
    }
    public function getApplicationTypeAttribute($value)
    {
        if($this->listed_by_deo=="YES")return "ডিও";
        return  "অন্যান্য রেফারেন্স";
    }

    public function scopePermitted($query, $type)
    {
        $user=Auth::user();
        if(!empty($user)&&$user->hasRole('super admin'))
            return $query;
        if(!empty($user)&&$user->hasRole('district admin')){
            $district_en=explode('_',$user->username)[0];
            $district=Bangladesh::where('district_en',$district_en)->first()->district;
            return $query->where('district',$district);
        }
        if(!empty($user)&&$user->hasRole('upazila admin')){
            $upazila_en_domain=explode('_',$user->username)[0];
            $district_en=explode('_',$user->username)[1];
            $upazila=Bangladesh::where('district_en',$district_en)->where('upazila_en_domain',$upazila_en_domain)->first()->upazila;
            $district=Bangladesh::where('district_en',$district_en)->first()->district;
            return $query->where('district',$district)->where('upazila',$upazila);
        }
        return $query;
    }

    public function scopeWhereLike($query, $column, $value)
    {
        return $query->where($column, 'like', '%'.$value.'%');
    }
    public function scopeWhereNotLike($query, $column, $value)
    {
        return $query->where($column, 'not like', '%'.$value.'%');
    }
    public function scopeOrWhereLike($query, $column, $value)
    {
        return $query->orWhere($column, 'like', '%'.$value.'%');
    }
    public function scopeOrWhereNotLike($query, $column, $value)
    {
        return $query->orWhere($column, 'not like', '%'.$value.'%');
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
    public function internet()
    {
        return $this->hasOne('App\Models\ApplicationInternetConnection','application_id');
    }
    public function trainees()
    {
        return $this->hasMany('App\Models\Trainee','application_id');
    }
    public function oldLabs()
    {
        return $this->hasMany('App\Models\ApplicationOldLab','application_id');
    }
    public function selectedLab()
    {
        return $this->hasOne('App\Models\Lab','srdl_code')->where('phase',2);
    }


}
