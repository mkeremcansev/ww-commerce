<?php

namespace App\Http\Controllers\Product\Repository;

use App\Http\Controllers\Product\Contract\ProductInterface;
use App\Http\Controllers\Product\Model\Product;

class ProductRepository implements ProductInterface
{
    /**
     * @var Product
     */
    public Product $product;

    /**
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @param string $slug
     * @return mixed
     */
    public function productBySlug(string $slug): mixed
    {
        return $this->product
            ->query()
            ->with(['attributes' => ['attribute', 'value']])
            ->whereSlug($slug)
            ->first();
    }
}
