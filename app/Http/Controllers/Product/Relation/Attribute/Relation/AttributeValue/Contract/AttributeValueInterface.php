<?php

namespace App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\Contract;

use App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\Model\AttributeValue;
use Illuminate\Support\Collection;

interface AttributeValueInterface
{
    public function attributeValueById($id): ?AttributeValue;

    public function attributeValueByCode(string $code): ?AttributeValue;

    public function attributeValuesByCodes(array $codes): ?Collection;

    public function attributeValues(array $columns = []): mixed;

    public function store($title, $code, $media, $attribute_id): AttributeValue;

    public function update($id, $title, $code, $media, $attribute_id): bool;

    public function attachMedia(AttributeValue $attributeValue, $media): mixed;

    public function destroyMedia(AttributeValue $attributeValue): void;

    public function destroy($id): bool;
}
