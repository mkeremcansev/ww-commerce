<?php

namespace App\Http\Controllers\Product\Helper;

use App\Http\Controllers\Product\Model\Product;

class ProductHelper
{
    /**
     * @param Product $product
     * @return Product
     */
    public function format(Product $product): Product
    {
        $product->variants = collect($product->attributes->groupBy('attribute.title'))->map(function ($items) {
            return collect($items)->map(function ($item) {
                return [
                    'name' => $item->value->title,
                    'code' => $item->value->code
                ];
            });
        });

        $product->variants =  collect($product->variants)->map(function ($item, $key){
            return (object)[
                'name' => $key,
                'attributes' => $item
            ];
        });

        return $product->makeHidden('attributes');
    }
}
