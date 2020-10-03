<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationAttachment extends Model
{
    protected $dates = [
        'old_application_date',
    ];
    protected $guarded = [];
    protected $table = 'application_attachments';


}
