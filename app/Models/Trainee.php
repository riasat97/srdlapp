<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainee extends Model
{
    public $table = 'trainees';


    //protected $dates = ['signature_at','deleted_at'];



    public $guarded=[];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => ['required', 'string', 'max:255'],
        'designation' => 'required|min:2',
        'subject' => '',
        'mobile' => 'required|regex:/(01)[0-9]{9}/',
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
    ];

    public function application()
    {
        return $this->hasOne(App\Models\Application::class);
    }

}
