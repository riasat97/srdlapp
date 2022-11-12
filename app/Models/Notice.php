<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Notice
 * @package App\Models
 * @version October 11, 2022, 11:45 am +06
 *
 * @property string $title
 * @property string $file1
 * @property string $file1_path
 * @property string $published_at
 */
class Notice extends Model
{
    use SoftDeletes;

    public $table = 'notices';


    protected $dates = ['published_at','deleted_at'];

    //protected $appends = ['list_attachment_file_path_type','ref_documents_file_path_type','verification_report_file_path_type'];

    public $fillable = [
        'title',
        'file',
        'file_path',
        'published_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        //'file1' => 'string',
        //'file1_path' => 'string',
        'published_at' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        //'file' => 'required|mimes:pdf,doc,docx|max:1024',
        'filenames' => 'required',
        'filenames.*' => 'mimes:doc,pdf,docx,zip|max:1024',
        'published_at' => 'required'
    ];

    public function getPublishedAtAttribute()
    {
        //dd($this->attributes['published_at']);
        //dd($this);
        return  Carbon::parse($this->attributes['published_at'])->toDayDateTimeString();
    }
    public function getFileAttribute()
    {
        if(!empty($this->file_path))
            return route('displayPdf',['id' => $this->attributes['id'],'path'=>'file_path']);
    }
    public function attachments()
    {
        return $this->hasMany('App\Models\NoticeAttachment');
    }
}
