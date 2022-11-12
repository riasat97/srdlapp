<?php

namespace App\Repositories;

use App\Models\Notice;
use App\Repositories\BaseRepository;

/**
 * Class NoticeRepository
 * @package App\Repositories
 * @version October 11, 2022, 11:45 am +06
*/

class NoticeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'file1',
        'file1_path',
        'published_at'
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
        return Notice::class;
    }
}
