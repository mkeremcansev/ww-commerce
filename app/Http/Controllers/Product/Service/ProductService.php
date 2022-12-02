<?php

namespace App\Http\Controllers\Product\Service;

use App\Http\Controllers\Product\Contract\ProductInterface;
use App\Http\Controllers\Product\Helper\ProductHelper;
use App\Http\Controllers\Product\Resource\ProductResource;

class ProductService
{
    /**
     * @param ProductInterface $repository
     * @param ProductHelper $helper
     */
    public function __construct(public ProductInterface $repository, public ProductHelper $helper)
    {
    }

    /**
     * @param string $slug
     * @return mixed
     */
    public function productBySlug(string $slug): mixed
    {
        $product = $this->repository->productBySlug($slug);

        return $product
            ? new ProductResource($this->helper->format($product))
            : null;
    }
}
