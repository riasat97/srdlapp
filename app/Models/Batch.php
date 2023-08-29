<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    public $table = 'batches';

    public function trainees()
    {
        return $this->hasMany('App\Models\Trainee','user_id','batch');
    }
}
