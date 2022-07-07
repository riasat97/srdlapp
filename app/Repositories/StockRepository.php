<?php

namespace App\Repositories;

use App\Models\Stock;
use App\Repositories\BaseRepository;

/**
 * Class StockRepository
 * @package App\Repositories
 * @version July 3, 2022, 6:05 pm +06
*/

class StockRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Stock::class;
    }
}
