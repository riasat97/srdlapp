<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationProfile extends Model
{
    protected $guarded = [];
    protected $table = 'application_profiles';
    protected $appends = ['tel'];

    public function getTelAttribute()
    {
        return (!empty($this->institution_tel))?
            $this->institution_tel.",".$this->alt_tel:0;
    }
}
