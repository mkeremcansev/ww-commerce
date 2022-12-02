<?php

namespace App\Http\Controllers\Product\Repository;

use App\Http\Controllers\Product\Contract\ProductInterface;
use App\Http\Controllers\Product\Enumeration\ProductStatusEnumeration;
use App\Http\Controllers\Product\Model\Product;

class ProductRepository implements ProductInterface
{
    /**
     * @param Product $product
     */
    public function __construct(public Product $product)
    {
    }

    /**
     * @param string $slug
     * @return mixed
     */
    public function productBySlug(string $slug): mixed
    {
        return $this->product
            ->query()
            ->with(['attributes' => ['values'], 'brand', 'categories'])
            ->whereSlug($slug)
            ->first();
    }
}
