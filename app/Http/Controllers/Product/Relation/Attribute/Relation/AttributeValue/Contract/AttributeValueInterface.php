<?php

namespace App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\Contract;

use App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\Model\AttributeValue;

interface AttributeValueInterface
{
    /**
     * @param $id
     * @return AttributeValue|null
     */
    public function attributeValueById($id): ? AttributeValue;

    /**
     * @param array $columns
     * @return mixed
     */
    public function attributeValues(array $columns = []): mixed;

    /**
     * @param $title
     * @param $code
     * @param $path
     * @param $attribute_id
     * @return AttributeValue
     */
    public function store($title, $code, $path, $attribute_id): AttributeValue;

    /**
     * @param $id
     * @param $title
     * @param $code
     * @param $path
     * @param $attribute_id
     * @return bool
     */
    public function update($id, $title, $code, $path, $attribute_id): bool;

    /**
     * @param $id
     * @return bool
     */
    public function destroy($id): bool;
}
