<?php

namespace App\Repositories;

use App\Models\Product;

/**
 * Class ProductRepository
 * @package App\Repositories
 * @version August 23, 2021, 3:26 pm UTC
*/

class ProductRepository extends BaseRepository
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
        return Product::class;
    }

    public function getProducts($params =[]) {
        $model = $this->model;

        if (isset($params['brand_id'])) {
            $model = $model->where('brand_id', $params['brand_id']);
        }

        return $model->orderBy('id', 'desc')->paginate();
    }
}
