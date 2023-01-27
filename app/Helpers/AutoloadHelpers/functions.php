<?php

use App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\Contract\AttributeValueInterface;

if (!function_exists('skuTitleGenerator')){
    /**
     * @param $title
     * @param $sku
     * @return string
     */
    function skuTitleGenerator($title, $sku): string
    {
        return $title . ' ' . rtrim($sku, '-');
    }
}


if (!function_exists('skuGenerator')){
    /**
     * @param $id
     * @param $sku
     * @return string
     */
    function skuGenerator($id, $sku): string
    {
        return rtrim($id . '-' . $sku, '-');
    }
}

if(!function_exists('skuFormatter')){
    /**
     * @param $sku
     * @param int $stock
     * @param $price
     * @return array
     */
    function skuFormatter($sku, int $stock, $price = null): array
    {
        $separator = skuSeparator($sku);
        $variants = [];
        if (count($separator) > 1) {
            unset($separator[0]);
            foreach ($separator as $value) {
                $variant = resolve(AttributeValueInterface::class)
                    ->attributeValueByCode($value);
                if ($variant) {
                    $variants[] = [
                        'stock' => $stock,
                        'price' => (float)$price,
                        'attributes' => [
                            [
                                'attribute_id' => $variant->attribute_id,
                                'attribute_value_id' => $variant->id,
                            ],
                        ]
                    ];
                }
            }

            return $variants;
        }

        return $variants;
    }
}
if (!function_exists('skuSeparator')){
    /**
     * @param $sku
     * @return string[]
     */
    function skuSeparator($sku): array
    {
        return explode('-', $sku);
    }
}

