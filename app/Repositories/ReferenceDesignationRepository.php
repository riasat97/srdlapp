<?php

namespace App\Repositories;

use App\Models\ReferenceDesignation;
use App\Repositories\BaseRepository;

/**
 * Class ReferenceDesignationRepository
 * @package App\Repositories
 * @version October 7, 2020, 7:33 am UTC
*/

class ReferenceDesignationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'ref_designation',
        'reference_id'
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
        return ReferenceDesignation::class;
    }
}
