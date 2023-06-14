<?php

namespace App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\Service;

use App\Helpers\DatatableHelper;
use App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\Contract\AttributeValueInterface;
use App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\Model\AttributeValue;
use Exception;

class AttributeValueService
{
    public function __construct(public AttributeValueInterface $repository)
    {
    }

    /**
     * @throws Exception
     */
    public function index(): mixed
    {
        return DatatableHelper::datatable($this->repository->attributeValues(['id', 'title', 'code']));
    }

    public function create(): mixed
    {
        return $this->repository->attributeValues();
    }

    public function store($title, $code, $media, $attribute_id): AttributeValue
    {
        return $this->repository->store($title, $code, $media, $attribute_id);
    }

    public function edit($id): ?AttributeValue
    {
        return $this->repository->attributeValueById($id);
    }

    public function update($id, $title, $code, $media, $attribute_id): bool
    {
        return $this->repository->update($id, $title, $code, $media, $attribute_id);
    }

    public function destroy($id): bool
    {
        return $this->repository->destroy($id);
    }
}
