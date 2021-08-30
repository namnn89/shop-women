<?php

namespace App\Services;

use App\Repositories\BrandRepository;

class BrandService
{
    protected $repository;

    public function __construct(BrandRepository $repository)
    {
        $this->repository = $repository;
    }
    public function getBrands() {
        return $this->repository->all();
    }
}
