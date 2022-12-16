<?php

namespace App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\Repository;

use App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\Contract\AttributeValueInterface;
use App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\Model\AttributeValue;

class AttributeValueRepository implements AttributeValueInterface
{
    public function __construct(public AttributeValue $model)
    {
    }

    /**
     * @param $id
     * @return AttributeValue|null
     */
    public function attributeValueById($id): ?AttributeValue
    {
        return $this->model
            ->whereId($id)
            ->first();
    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function attributeValues(array $columns = []): mixed
    {
        return $this->model
            ->when(count($columns),
                fn($eloquent) => $eloquent->select($columns),
                fn($eloquent) => $eloquent->get()
            );
    }

    /**
     * @param $title
     * @param $code
     * @param $path
     * @param $attribute_id
     * @return AttributeValue
     */
    public function store($title, $code, $path, $attribute_id): AttributeValue
    {
        return $this->model->create([
            'title' => $title,
            'code' => $code,
            'path' => $path,
            'attribute_id' => $attribute_id
        ]);
    }

    /**
     * @param $id
     * @param $title
     * @param $code
     * @param $path
     * @param $attribute_id
     * @return bool
     */
    public function update($id, $title, $code, $path, $attribute_id): bool
    {
        $attributeValue = $this->attributeValueById($id);

        return $attributeValue && $attributeValue->update([
                'title' => $title,
                'code' => $code,
                'path' => $path,
                'attribute_id' => $attribute_id
            ]);
    }

    /**
     * @param $id
     * @return bool
     */
    public function destroy($id): bool
    {
        $attributeValue = $this->attributeValueById($id);

        return $attributeValue && $attributeValue->delete();
    }
}
