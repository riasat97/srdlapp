<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banbeis extends Model
{
    protected $table = 'banbeis';
    protected $primaryKey = 'eiin';
    protected $keyType = 'string';

    public function banbeisFacility()
    {
        return $this->hasOne('App\Models\BanbeisFacility','eiin','eiin');
    }
    public function banbeisLab(){
        return $this->hasOne('App\Models\BanbeisLab','eiin','eiin');
    }
}
