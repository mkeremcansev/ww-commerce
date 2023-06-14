<?php

namespace App\Http\Controllers\Product\Relation\Attribute\Service;

use App\Helpers\DatatableHelper;
use App\Http\Controllers\Product\Relation\Attribute\Contract\AttributeInterface;
use App\Http\Controllers\Product\Relation\Attribute\Model\Attribute;
use Exception;

class AttributeService
{
    public function __construct(public AttributeInterface $repository)
    {
    }

    /**
     * @throws Exception
     */
    public function index(): mixed
    {
        return DatatableHelper::datatable($this->repository->attributes(['id', 'title']));
    }

    public function store($title): Attribute
    {
        return $this->repository->store($title);
    }

    public function edit($id): ?Attribute
    {
        return $this->repository->attributeById($id);
    }

    public function update($id, $title): bool
    {
        return $this->repository->update($id, $title);
    }

    public function destroy($id): bool
    {
        return $this->repository->destroy($id);
    }
}
