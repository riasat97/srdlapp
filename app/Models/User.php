<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    //use SoftDeletes;
    use Notifiable,HasRoles;

    public $table = 'users';


    protected $dates = ['deleted_at'];



    public $guarded=[];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'username' => 'string',
        'name' => 'string',
        'designation' => 'string',
        'posting_type' => 'string',
        'mobile' => 'string',
        'email' => 'string',
        'email_verified_at' => 'datetime',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => ['required', 'string', 'max:255'],
        'designation' => 'required|min:2',
        'posting_type' => '',
        'mobile' => 'required|regex:/(01)[0-9]{9}/',
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
    ];

    protected $hidden = [

        'password', 'remember_token','otp'
    ];

}
