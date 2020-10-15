<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Bangladesh extends Model
{
    protected $table = 'bangladesh';
    public $timestamps = false;

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
}
