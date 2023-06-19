<?php

namespace App\Http\Struct\Product\Relation\Attribute\Repository;

use App\Http\Struct\Product\Relation\Attribute\Contract\AttributeInterface;
use App\Http\Struct\Product\Relation\Attribute\Model\Attribute;

class AttributeRepository implements AttributeInterface
{
    public function __construct(public Attribute $model)
    {
    }

    public function attributeById($id, $trashed = false): ?Attribute
    {
        return $this->model
            ->when($trashed, fn ($query) => $query->onlyTrashed())
            ->whereId($id)
            ->first();
    }

    public function attributes(array $columns = [], array $relation = [], bool|null $trashed = false): mixed
    {
        return $this->model
            ->when($trashed, fn ($query) => $query->onlyTrashed())
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

    public function restore($id): ?bool
    {
        $attribute = $this->attributeById($id, true);

        return $attribute?->restore();
    }

    public function forceDelete($id): ?bool
    {
        $attribute = $this->attributeById($id, true);

        return $attribute?->forceDelete();
    }
}
