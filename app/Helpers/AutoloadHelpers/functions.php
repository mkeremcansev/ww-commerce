<?php

use App\Http\Struct\Product\Relation\Attribute\Contract\AttributeInterface;
use App\Http\Struct\Product\Relation\Attribute\Relation\AttributeValue\Contract\AttributeValueInterface;

if (! function_exists('skuTitleGenerator')) {

    function skuTitleGenerator($title, $sku): string
    {
        return $title.' '.rtrim($sku, '-');
    }
}

if (! function_exists('skuGenerator')) {

    function skuGenerator($id, $sku): string
    {
        return rtrim($id.'-'.$sku, '-');
    }
}

if (! function_exists('skuFormatter')) {

    function skuFormatter($sku, int $stock, $price = null): array
    {
        $explodedSku = explode('-', $sku);
        $attributeValues = resolve(AttributeValueInterface::class)
            ->attributeValuesByCodes($explodedSku);

        return [
            'stock' => $stock,
            'price' => (float) $price,
            'attributes' => $attributeValues->map(function ($attributeValue) {
                $attributeValue->attribute_value_id = $attributeValue->id;

                return $attributeValue;
            })->toArray(),
        ];
    }
}

if (! function_exists('variantCombination')) {

    function variantCombination(): array
    {
        $attributes = resolve(AttributeInterface::class)->attributes([], ['values']);
        $combinations = [];
        foreach ($attributes as $attribute) {
            if (empty($combinations)) {
                foreach ($attribute->values as $value) {
                    $combinations[] = [['attribute_id' => $attribute->id, 'attribute_value_id' => $value->id]];
                }
            } else {
                $newCombinations = [];
                foreach ($combinations as $combination) {
                    foreach ($attribute->values as $value) {
                        $newCombination = $combination;
                        $newCombination[] = ['attribute_id' => $attribute->id, 'attribute_value_id' => $value->id];
                        $newCombinations[] = $newCombination;
                    }
                }
                $combinations = $newCombinations;
            }
        }
        $variants = [];
        foreach ($combinations as $combination) {
            $variants[] = [
                'stock' => rand(1, 100),
                'price' => (float) rand(100, 1000),
                'attributes' => $combination,
            ];
        }

        return $variants;
    }
}

if (! function_exists('toObject')) {

    function toObject($array, &$object): mixed
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $object->$key = new stdClass();
                toObject($value, $object->$key);
            } else {
                $object->$key = $value;
            }
        }

        return $object;
    }
}

if (! function_exists('convertKeyToProperty')) {

    function convertKeyToProperty($object, $property): mixed
    {
        foreach ($object as $key => $value) {
            $value->$property = $key;
        }

        return $object;
    }
}
