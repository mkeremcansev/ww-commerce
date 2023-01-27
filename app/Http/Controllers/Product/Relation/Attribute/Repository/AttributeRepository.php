<?php

namespace App\Http\Controllers\Product\Relation\Attribute\Repository;

use App\Http\Controllers\Product\Relation\Attribute\Contract\AttributeInterface;
use App\Http\Controllers\Product\Relation\Attribute\Model\Attribute;

class AttributeRepository implements AttributeInterface
{
    /**
     * @param Attribute $model
     */
    public function __construct(public Attribute $model)
    {
    }

    /**
     * @param $id
     * @return Attribute|null
     */
    public function attributeById($id): ?Attribute
    {
        return $this->model
            ->whereId($id)
            ->first();
    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function attributes(array $columns = []): mixed
    {
        return $this->model
            ->when(count($columns),
                fn($eloquent) => $eloquent->select($columns),
                fn($eloquent) => $eloquent->get()
            );
    }

    /**
     * @param $title
     * @return Attribute
     */
    public function store($title): Attribute
    {
        return $this->model->create([
            'title' => $title
        ]);
    }

    /**
     * @param $id
     * @param $title
     * @return bool
     */
    public function update($id, $title): bool
    {
        $attribute = $this->attributeById($id);

        return $attribute && $attribute->update([
                'title' => $title
            ]);
    }

    /**
     * @param $id
     * @return bool
     */
    public function destroy($id): bool
    {
        $attribute = $this->attributeById($id);

        return $attribute && $attribute->delete();
    }

    /**
     * @param $title
     * @return Attribute
     */
    public function firstOrCreate($title): Attribute
    {
        return $this->model->firstOrCreate([
            'title' => $title
        ]);
    }
}
