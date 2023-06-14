<?php

namespace App\Http\Controllers\Product\Relation\Attribute\Contract;

use App\Http\Controllers\Product\Relation\Attribute\Model\Attribute;

interface AttributeInterface
{
    public function attributeById($id): ?Attribute;

    public function attributes(array $columns = [], array $relation = []): mixed;

    public function store($title): Attribute;

    public function update($id, $title): bool;

    public function destroy($id): bool;

    public function firstOrCreate($title): Attribute;
}
