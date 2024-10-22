<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Lab extends Model
{
    protected $appends = ['constituency','ins','tel','phase_bn'];

    /*public function getLabTypeAttribute($value)
    {
        $labTypeArr= lab_type();
        return $labTypeArr[$value];
    }*/
    public function getPhaseBnAttribute(){
        $phase= phase();
        return !empty($this->phase)? $phase[$this->phase]:null;
    }
    public function getTelAttribute()
    {
        return (!empty($this->institution_tel))?
            $this->institution_tel.",".$this->alt_tel:0;
    }
   /* public function getPhaseAttribute($value)
   {
       $phase= phase();
       return $phase[$value];
   }*/
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
    private function getLabId(Lab $lab)
    {
        if($lab->lab_type=="srdl")return $lab->id;
        if($lab->lab_type=="sof")return $lab->id." (SOF)";
        if($lab->lab_type=="srdl_sof")return $lab->id." (SOF & SRDL)";

    }
    public function getInsAttribute()
    {
        $labId=$this->getLabId($this);
        if(!empty($this->institution_corrected)) return $this->institution_corrected.'-'.$labId;
        return $this->institution.'-'.$labId;
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
        if(!empty($user)&&$user->hasRole('vendor')){
            $divisions_en=explode(',',$user->posting_type);
            $divisions_bn=$this->getDivisionBn($divisions_en);
            $query->whereIn('division',$divisions_bn )->where('phase',2);
            return $query;
        }
        if(!empty($user)&&$user->hasRole('trainer')){
            $query->where('user_id',$user->id);
            return $query;
        }
        return $query;
    }
    private function getDivisionBn(array $divisions_en)
    {
        $division_bn=[];
        foreach ( $divisions_en as $division_en){
            $division_bn[]=divisionEnToBn()[$division_en];
        }
        return $division_bn;
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
        return $query->orWhere($column, 'not like', '%' . $value . '%');
    }

    public function stock()
    {
        return $this->hasOne('App\Models\Stock','lab_id');
    }

    public function trainees()
    {
        return $this->hasMany('App\Models\Trainee','lab_id');
    }
    public function devices()
    {
        return $this->hasMany('App\Models\Device','lab_id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
}
