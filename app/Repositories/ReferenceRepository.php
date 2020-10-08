<?php

namespace App\Repositories;

use App\Models\Reference;
use App\Repositories\BaseRepository;

/**
 * Class ReferenceRepository
 * @package App\Repositories
 * @version October 7, 2020, 7:01 am UTC
*/

class ReferenceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'ref_type'
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
        return Reference::class;
    }
}
