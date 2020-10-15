<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Reference
 * @package App\Models
 * @version October 7, 2020, 7:01 am UTC
 *
 * @property string $ref_type
 */
class Reference extends Model
{
    //use SoftDeletes;

    public $table = 'references';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'ref_type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'ref_type' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'ref_type' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function referenceDesignations()
    {
        return $this->hasOne('App\Models\ReferenceDesignation','reference_id');
    }


}
