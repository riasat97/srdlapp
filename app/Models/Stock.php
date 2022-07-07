<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Stock
 * @package App\Models
 * @version July 3, 2022, 6:05 pm +06
 *
 * @property string $contract
 * @property & $renovation
 * @property string $laptop
 * @property string $printer
 * @property string $scanner
 * @property switch $network
 * @property smart $led
 * @property camera $web
 * @property and $networking
 * @property string $furniture
 * @property board $smart
 * @property string $desktop
 * @property router $industrial
 * @property reader $attendance
 * @property id $digital
 */
class Stock extends Model
{
    use SoftDeletes;

    public $table = 'stocks';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'lab_id',
        'contract',
        'renovation',
        'laptop',
        'printer',
        'scanner',
        'router',
        'network_switch',
        'led_tv',
        'webcam',
        'networking',
        'furniture',
        'sof_contract',
        'smart_board',
        'desktop',
        'industrial_router',
        'attendance_reader',
        'digital_id_card'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'contract' => 'string',
        'laptop' => 'string',
        'printer' => 'string',
        'scanner' => 'string',
        'furniture' => 'string',
        'desktop' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'contract' => 'required',
        'renovation' => 'required',
        'laptop' => 'required',
        'printer' => 'required',
        'scanner' => 'required',
        'router' => 'required',
        'network_switch' => 'required',
        'led_tv' => 'required',
        'webcam' => 'required',
        'networking' => 'required',
        'furniture' => 'required',
        'smart_board' => 'required',
        'desktop' => 'required',
        'industrial_router' => 'required',
        'attendance_reader' => 'required',
        'digital_id_card' => 'required'
    ];

    public function lab()
    {
        return $this->belongsTo('App\Models\Lab','lab_id');
    }
}
