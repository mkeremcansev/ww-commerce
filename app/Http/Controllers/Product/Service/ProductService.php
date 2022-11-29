<?php

namespace App\Http\Controllers\Product\Service;

use App\Http\Controllers\Product\Contract\ProductInterface;
use App\Http\Controllers\Product\Helper\ProductHelper;
use App\Http\Controllers\Product\Resource\ProductResource;

class ProductService
{
    /**
     * @var ProductInterface
     */
    public ProductInterface $repository;

    /**
     * @var ProductHelper
     */
    public ProductHelper $helper;

    /**
     * @param ProductInterface $repository
     * @param ProductHelper $helper
     */
    public function __construct(ProductInterface $repository, ProductHelper $helper)
    {
        $this->repository = $repository;
        $this->helper = $helper;
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
