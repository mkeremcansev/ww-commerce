<?php

namespace App\Http\Struct\Product\Relation\Attribute\Contract;

use App\Http\Struct\Product\Relation\Attribute\Model\Attribute;

interface AttributeInterface
{
    public function attributeById($id, $trashed = false): ?Attribute;

    public function attributes(array $columns = [], array $relation = [], bool|null $trashed = false): mixed;

    public function store($title): Attribute;

    public function update($id, $title): bool;

    public function destroy($id): ?bool;

    public function firstOrCreate($title): Attribute;

    public function restore($id): ?bool;

    public function forceDelete($id): ?bool;
}
