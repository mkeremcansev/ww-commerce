<?php

namespace App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\Service;

use App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\Contract\AttributeValueInterface;
use App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\Model\AttributeValue;

class AttributeValueService
{
    /**
     * @param AttributeValueInterface $repository
     */
    public function __construct(public AttributeValueInterface $repository)
    {
    }

    /**
     * @return mixed
     */
    public function index(): mixed
    {
        return $this->repository->attributeValues(['id', 'title', 'code', 'path']);
    }

    /**
     * @return mixed
     */
    public function create(): mixed
    {
        return $this->repository->attributeValues();
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
        return $this->repository->store($title, $code, $path, $attribute_id);
    }

    /**
     * @param $id
     * @return AttributeValue|null
     */
    public function edit($id): ?AttributeValue
    {
        return $this->repository->attributeValueById($id);
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
        return $this->repository->update($id, $title, $code, $path, $attribute_id);
    }

    /**
     * @param $id
     * @return bool
     */
    public function destroy($id): bool
    {
        return $this->repository->destroy($id);
    }
}
