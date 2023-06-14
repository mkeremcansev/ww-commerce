<?php

namespace App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\Service;

use App\Helpers\DatatableHelper;
use App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\Contract\AttributeValueInterface;
use App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\Model\AttributeValue;
use Exception;

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
     * @throws Exception
     */
    public function index(): mixed
    {
        return DatatableHelper::datatable($this->repository->attributeValues(['id', 'title', 'code']));
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
     * @param $media
     * @param $attribute_id
     * @return AttributeValue
     */
    public function store($title, $code, $media, $attribute_id): AttributeValue
    {
        return $this->repository->store($title, $code, $media, $attribute_id);
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
     * @param $media
     * @param $attribute_id
     * @return bool
     */
    public function update($id, $title, $code, $media, $attribute_id): bool
    {
        return $this->repository->update($id, $title, $code, $media, $attribute_id);
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
