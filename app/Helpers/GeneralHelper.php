<?php

namespace App\Helpers;


use App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\Contract\AttributeValueInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use stdClass;

class GeneralHelper
{
    /**
     * @param $id
     * @param $sku
     * @return string
     */
    public static function skuGenerator($id, $sku): string
    {
        return rtrim($id . '-' . $sku, '-');
    }

    /**
     * @param $title
     * @param $sku
     * @return string
     */
    public static function skuTitleGenerator($title, $sku): string
    {
        return $title . ' ' . rtrim($sku, '-');
    }

    /**
     * @param $sku
     * @return string[]
     */
    public static function skuSeparator($sku): array
    {
        return explode('-', $sku);
    }

    /**
     * @param $sku
     * @param int $stock
     * @param null $price
     * @return array
     * @throws BindingResolutionException
     */
    public static function skuFormatter($sku, int $stock, $price = null): array
    {
        $separator = self::skuSeparator($sku);
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
