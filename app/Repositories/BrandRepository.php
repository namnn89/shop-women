<?php

namespace App\Repositories;

use App\Models\Brand;

/**
 * Class BrandRepository
 * @package App\Repositories
 * @version August 23, 2021, 3:27 pm UTC
*/

class BrandRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
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
        return Brand::class;
    }
}
