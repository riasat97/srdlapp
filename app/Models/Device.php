<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

}
