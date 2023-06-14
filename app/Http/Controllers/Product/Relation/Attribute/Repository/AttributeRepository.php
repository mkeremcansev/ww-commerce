<?php

namespace App\Http\Controllers\Product\Relation\Attribute\Repository;

use App\Http\Controllers\Product\Relation\Attribute\Contract\AttributeInterface;
use App\Http\Controllers\Product\Relation\Attribute\Model\Attribute;

class AttributeRepository implements AttributeInterface
{
    public function __construct(public Attribute $model)
    {
    }

    public function attributeById($id): ?Attribute
    {
        return $this->model
            ->whereId($id)
            ->first();
    }

    public function attributes(array $columns = [], array $relation = []): mixed
    {
        return $this->model
            ->when(count($columns),
                fn ($eloquent) => $eloquent->select($columns),
                fn ($eloquent) => $eloquent->when(count($relation),
                    fn ($eloquent) => $eloquent->with($relation)
                )->get()
            );
    }

    public function store($title): Attribute
    {
        return $this->model->create([
            'title' => $title,
        ]);
    }

    public function update($id, $title): bool
    {
        $attribute = $this->attributeById($id);

        return $attribute && $attribute->update([
            'title' => $title,
        ]);
    }

    public function destroy($id): ?bool
    {
        $attribute = $this->attributeById($id);

        return $attribute?->delete();
    }

    public function firstOrCreate($title): Attribute
    {
        return $this->model->firstOrCreate([
            'title' => $title,
        ]);
    }
}
