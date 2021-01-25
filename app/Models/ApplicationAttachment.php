<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationAttachment extends Model
{
    protected $dates = [
        'old_application_date',
    ];
    protected $guarded = [];
    protected $appends = ['list_attachment_file_path_type','ref_documents_file_path_type','verification_report_file_path_type'];
    protected $table = 'application_attachments';

    public function getRefTypeAttribute($value)
    {
        $refTypeArr= ref_type();
        if($value)
        return $refTypeArr[$value];
    }
    public function getListAttachmentFileAttribute()
    {
        //$list_attachment_file=$this->getListAttachmentFileIfNotExists($this);
//        if(!empty($list_attachment_file)){
//            if(filter_var($list_attachment_file->list_attachment_file_path, FILTER_VALIDATE_URL))
//                return $list_attachment_file->list_attachment_file_path;
//            elseif(!empty($list_attachment_file->list_attachment_file_path))
//                return route('applications.displayPdf',['id' => $list_attachment_file->application_attachment_id,'path'=>'list_attachment_file_path']);
//        }
        if(!empty($this->attributes['list_attachment_file_path'])){
            if(filter_var($this->attributes['list_attachment_file_path'], FILTER_VALIDATE_URL))
                return $this->attributes['list_attachment_file_path'];
            elseif(!empty($this->list_attachment_file_path))
                return route('applications.displayPdf',['id' => $this->attributes['application_attachment_id'],'path'=>'list_attachment_file_path']);
        }
    }
    private function getListAttachmentFileIfNotExists(ApplicationAttachment $attachment)
    {

        if($attachment->application->attributes['listed_by_deo']=="YES" && empty($attachment->attributes['list_attachment_file_path'])){
            $seat_no=$attachment->application->attributes['seat_no'];
            $list_attachment_file=$attachment->whereNotNull('list_attachment_file_path')->whereHas('application', function ($query) use($seat_no) {
                $query->where('seat_no', $seat_no);
            })->first();
            //dd($list_attachment_file);
            return  $list_attachment_file;
        }
        return null;
    }
    public function getListAttachmentFilePathTypeAttribute($value)
    {
        //$list_attachment_file=$this->getListAttachmentFileIfNotExists($this);
//        if(!empty($list_attachment_file)){
//            if(filter_var($list_attachment_file->list_attachment_file_path, FILTER_VALIDATE_URL))
//                return "প্রেরিত তালিকাটি দেখুন- google drive" ;
//            elseif(!empty($list_attachment_file->list_attachment_file_path))
//                return "প্রেরিত তালিকাটি দেখুন- local drive";
//        }

        if(!empty($this->attributes['list_attachment_file_path'])){}
        if(filter_var($this->attributes['list_attachment_file_path'], FILTER_VALIDATE_URL))
            return "প্রেরিত তালিকাটি দেখুন- google drive" ;
        elseif(!empty($this->attributes['list_attachment_file_path']))
            return "প্রেরিত তালিকাটি দেখুন- local drive";

    }
    public function getRefDocumentsFileAttribute($value)
    {
        if(!empty($this->attributes['ref_documents_file_path'])){
            if(filter_var($this->attributes['ref_documents_file_path'], FILTER_VALIDATE_URL))
                return $this->attributes['ref_documents_file_path'];
            elseif(!empty($this->attributes['ref_documents_file_path']))
                return route('applications.displayPdf',['id' => $this->attributes['application_attachment_id'],'path'=>'ref_documents_file_path']);
        }
    }
    public function getRefDocumentsFilePathTypeAttribute($value)
    {
        if(!empty($this->attributes['ref_documents_file_path'])){
            if(filter_var($this->attributes['ref_documents_file_path'], FILTER_VALIDATE_URL))
                return "পসুপারিশ সম্পর্কিত ডকুমেন্টসটি দেখুন- google drive" ;
            elseif(!empty($this->attributes['ref_documents_file_path']))
                return "সুপারিশ সম্পর্কিত ডকুমেন্টসটি দেখুন- local drive";
        }
    }
    public function getVerificationReportFileAttribute($value)
    {
        if(!empty($this->attributes['verification_report_file_path'])){
            if(filter_var($this->attributes['verification_report_file_path'], FILTER_VALIDATE_URL))
                return $this->attributes['verification_report_file_path'];
            elseif(!empty($this->attributes['verification_report_file_path']))
                return route('applications.displayPdf',['id' => $this->attributes['application_attachment_id'],'path'=>'verification_report_file_path']);
        }
    }
    public function getVerificationReportFilePathTypeAttribute($value)
    {
        if(!empty($this->attributes['verification_report_file_path'])){
            if(filter_var($this->attributes['verification_report_file_path'], FILTER_VALIDATE_URL))
                return "পসুপারিশ সম্পর্কিত ডকুমেন্টসটি দেখুন- google drive" ;
            elseif(!empty($this->attributes['verification_report_file_path']))
                return "সুপারিশ সম্পর্কিত ডকুমেন্টসটি দেখুন- local drive";
        }
    }
    public function application()
    {
        return $this->belongsTo('App\Models\Application','application_attachment_id');
    }
}
