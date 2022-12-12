<?php

namespace App\Http\Controllers\Product\Relation\Brand\Service;

use App\Http\Controllers\Product\Relation\Brand\Contract\BrandInterface;
use App\Http\Controllers\Product\Relation\Brand\Model\Brand;

class BrandService
{
    /**
     * @param BrandInterface $repository
     */
    public function __construct(public BrandInterface $repository)
    {
    }

    /**
     * @param $title
     * @param $slug
     * @param $path
     * @return Brand
     */
    public function store($title, $slug, $path): Brand
    {
        return $this->repository->store($title, $slug, $path);
    }
}
