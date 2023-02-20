<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Trainee extends Model
{
    public $table = 'trainees';


    //protected $dates = ['signature_at','deleted_at'];



    public $guarded=[];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => ['required', 'string', 'max:255'],
        'designation' => 'required|min:2',
        'subject' => '',
        'mobile' => 'required|regex:/(01)[0-9]{9}/',
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
    ];
    public function getDesignationAttribute($value)
    {
        return trainee_designations()[$value];
    }
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->addHours(6)->toDayDateTimeString();
    }
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->addHours(6)->toDayDateTimeString();
    }
    public function application()
    {
        return $this->hasOne(App\Models\Application::class);
    }

    public function lab()
    {
        return $this->belongsTo('App\Models\Lab','lab_id');
    }
    public function scopePermitted($query, $request)
    {
        $user=Auth::user();
        if(!empty($user)&&$user->hasRole('super admin')){
            if(!empty($request->get('lab_id'))){
                $labId=$request->get('lab_id');
                $query->whereHas('lab', function ($data) use ($labId) {
                    $data->where('id',$labId);
                });
                return  $query;
            }
            return $query;
        }
        if(!empty($user)&&$user->hasRole('district admin')){
            $district_en=explode('_',$user->username)[0];
            $district=Bangladesh::where('district_en',$district_en)->first()->district;
            $query->whereHas('lab', function ($data) use ($district) {
                $data->where('district',$district);
            });
            return $query;
        }
        if(!empty($user)&&$user->hasRole('upazila admin')){
            $upazila_en_domain=explode('_',$user->username)[0];
            $district_en=explode('_',$user->username)[1];
            $upazila=Bangladesh::where('district_en',$district_en)->where('upazila_en_domain',$upazila_en_domain)->first()->upazila;
            $district=Bangladesh::where('district_en',$district_en)->first()->district;
            $query->whereHas('lab', function ($data) use ($upazila,$district) {
                $data->where('district',$district)->where('upazila',$upazila);
            });
            return $query;
        }
        if(!empty($user)&&$user->hasRole('vendor')){
            $divisions_en=explode(',',$user->posting_type);
            $divisions_bn=$this->getDivisionBn($divisions_en);
            $query->whereHas('lab', function ($data) use ($divisions_bn) {
                $data->whereIn('labs.division',$divisions_bn )->where('phase',2);
            });
            $devices=explode(',',$user->designation);
            return $query->whereIn('device',$devices);
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

}
