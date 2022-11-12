<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoticeAttachment extends Model
{
    protected $guarded = [];
    protected $appends = [];
    protected $table = 'notice_attachments';

    public function getFileAttribute()
    {
        if(!empty($this->file_path))
            return route('displayPdf',['id' => $this->attributes['id'],'path'=>'file_path']);
    }

    public function notice()
    {
        return $this->belongsTo('App\Models\Notice','notice_id');
    }
}
