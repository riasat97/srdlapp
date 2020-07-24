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
    public function banbeisExtra(){
        return $this->hasOne('App\Models\BanbeisExtra','eiin','eiin');
    }
//    public function fromBd(){
//        return $this->hasOne('App\Models\Bd','division_en','division')->where('district_en', $this->district)
//            ->where('upazila_en',$this->upazila);
//    }
}
