<?php

namespace App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\Contract;

use App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\Model\AttributeValue;
use Illuminate\Support\Collection;

interface AttributeValueInterface
{
    /**
     * @param $id
     * @return AttributeValue|null
     */
    public function attributeValueById($id): ? AttributeValue;

    /**
     * @param string $code
     * @return AttributeValue|null
     */
    public function attributeValueByCode(string $code): ?AttributeValue;

    /**
     * @param array $codes
     * @return Collection|null
     */
    public function attributeValuesByCodes(array $codes): ?Collection;

    /**
     * @param array $columns
     * @return mixed
     */
    public function attributeValues(array $columns = []): mixed;

    /**
     * @param $title
     * @param $code
     * @param $media
     * @param $attribute_id
     * @return AttributeValue
     */
    public function store($title, $code, $media, $attribute_id): AttributeValue;

    /**
     * @param $id
     * @param $title
     * @param $code
     * @param $media
     * @param $attribute_id
     * @return bool
     */
    public function update($id, $title, $code, $media, $attribute_id): bool;

    /**
     * @param AttributeValue $attributeValue
     * @param $media
     * @return mixed
     */
    public function attachMedia(AttributeValue $attributeValue, $media): mixed;

    /**
     * @param AttributeValue $attributeValue
     * @return void
     */
    public function destroyMedia(AttributeValue $attributeValue): void;

    /**
     * @param $id
     * @return bool
     */
    public function destroy($id): bool;
}
