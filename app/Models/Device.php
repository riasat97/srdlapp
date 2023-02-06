<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Device extends Model
{
    protected $guarded = [];
    protected $appends = ['attachment_file'];

    public function getAttachmentFileAttribute($value)
    {
        if(empty($this->attributes['attachment_file'])) return '';
        if(!empty($this->attributes['attachment_file_path'])){
            if(filter_var($this->attributes['attachment_file_path'], FILTER_VALIDATE_URL))
                return $this->attributes['attachment_file_path'];
            elseif(!empty($this->attributes['attachment_file_path']))
                return route('labs.displayImage',$this->attributes['attachment_file']);
        }
    }

    function lab() {

        return $this->belongsTo('App\Models\Lab','lab_id');
    }

    public function scopePermitted($query, $type)
    {
        $user=Auth::user();
        if(!empty($user)&&$user->hasRole('super admin'))
            return $query;
        if(!empty($user)&&$user->hasRole('vendor')){
            $divisions_en=explode(',',$user->posting_type);
            $divisions_bn=$this->getDivisionBn($divisions_en);
            $query->whereHas('lab', function ($data) use ($divisions_bn) {
                $data->whereIn('labs.division',$divisions_bn );
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
