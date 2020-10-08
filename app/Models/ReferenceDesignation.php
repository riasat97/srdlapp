<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ReferenceDesignation
 * @package App\Models
 * @version October 7, 2020, 7:33 am UTC
 *
 * @property string $ref_designation
 * @property integer $reference_id
 */
class ReferenceDesignation extends Model
{
    //use SoftDeletes;

    public $table = 'reference_designations';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'ref_designation',
        'reference_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'ref_designation' => 'string',
        'reference_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'ref_designation' => 'required',
        'reference_id' => 'required'
    ];


}
