<?php

namespace App\Http\Controllers\Product\Service;

use App\Http\Controllers\Product\Contract\ProductInterface;
use App\Http\Controllers\Product\ResourceCollection\ProductResourceCollection;

class ProductService
{
    /**
     * @param ProductInterface $repository
     */
    public function __construct(public ProductInterface $repository)
    {
    }

    /**
     * @param string $slug
     * @return mixed
     */
    public function productBySlug(string $slug): mixed
    {
        return $this->repository->productBySlug($slug);
    }
}
