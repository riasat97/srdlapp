<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationVerification extends Model
{
    protected $guarded = [];
    protected $table = 'application_verifications';

    protected $dates = ['app_district_verified_at'];

}
