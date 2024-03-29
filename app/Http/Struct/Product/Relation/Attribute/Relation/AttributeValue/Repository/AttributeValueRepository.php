<?php

namespace App\Http\Struct\Product\Relation\Attribute\Relation\AttributeValue\Repository;

use App\Http\Struct\Product\Relation\Attribute\Relation\AttributeValue\Contract\AttributeValueInterface;
use App\Http\Struct\Product\Relation\Attribute\Relation\AttributeValue\Model\AttributeValue;
use Illuminate\Support\Collection;

class AttributeValueRepository implements AttributeValueInterface
{
    public function __construct(public AttributeValue $model)
    {
    }

    public function attributeValueById($id, $trashed = false): ?AttributeValue
    {
        return $this->model
            ->when($trashed, fn ($query) => $query->onlyTrashed())
            ->whereId($id)
            ->first();
    }

    public function attributeValueByCode(string $code): ?AttributeValue
    {
        return $this->model
            ->whereCode($code)
            ->first();
    }

    public function attributeValuesByCodes(array $codes): ?Collection
    {
        return $this->model
            ->whereIn('code', $codes)
            ->get();
    }

    public function attributeValues(array $columns = [], bool|null $trashed = false): mixed
    {
        return $this->model
            ->when($trashed, fn ($query) => $query->onlyTrashed())
            ->when(count($columns),
                fn ($eloquent) => $eloquent->select($columns),
                fn ($eloquent) => $eloquent->get()
            );
    }

    public function store($title, $code, $media, $attribute_id): AttributeValue
    {
        $attributeValue = $this->model->create([
            'title' => $title,
            'code' => $code,
            'attribute_id' => $attribute_id,
        ]);
       $this->attachMedia($attributeValue, $media);

        return $attributeValue;
    }

    public function update($id, $title, $code, $media, $attribute_id): bool
    {
        $attributeValue = $this->attributeValueById($id);

        if ($attributeValue) {
            $this->destroyMedia($attributeValue);
            $this->attachMedia($attributeValue, $media);

            return $attributeValue->update([
                'title' => $title,
                'code' => $code,
                'attribute_id' => $attribute_id,
            ]);
        }

        return false;
    }

    public function attachMedia(AttributeValue $attributeValue, $media): mixed
    {
        return $attributeValue
            ->addMediaFromId($media['id']);
    }

    public function destroyMedia(AttributeValue $attributeValue): void
    {
        $attributeValue->destroyMedia();
    }

    public function destroy($id): ?bool
    {
        $attributeValue = $this->attributeValueById($id);

        return $attributeValue?->delete();
    }

    public function restore($id): ?bool
    {
        $attributeValue = $this->attributeValueById($id, true);

        return $attributeValue?->restore();
    }

    public function forceDelete($id): ?bool
    {
        $attributeValue = $this->attributeValueById($id, true);

        return $attributeValue?->forceDelete();
    }
}
