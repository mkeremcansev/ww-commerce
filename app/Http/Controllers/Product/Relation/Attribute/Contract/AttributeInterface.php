<?php

namespace App\Http\Controllers\Product\Relation\Attribute\Contract;

use App\Http\Controllers\Product\Relation\Attribute\Model\Attribute;

interface AttributeInterface
{
    /**
     * @param $id
     * @return Attribute|null
     */
    public function attributeById($id): ?Attribute;

    /**
     * @param array $columns
     * @param array $relation
     * @return mixed
     */
    public function attributes(array $columns = [], array $relation = []): mixed;

    /**
     * @param $title
     * @return Attribute
     */
    public function store($title): Attribute;

    /**
     * @param $id
     * @param $title
     * @return bool
     */
    public function update($id, $title): bool;

    /**
     * @param $id
     * @return bool
     */
    public function destroy($id): bool;

    /**
     * @param $title
     * @return Attribute
     */
    public function firstOrCreate($title): Attribute;
}
