<?php

namespace App\Http\Struct\Product\Relation\Attribute\Service;

use App\Helpers\DatatableHelper;
use App\Http\Struct\Product\Relation\Attribute\Contract\AttributeInterface;
use App\Http\Struct\Product\Relation\Attribute\Model\Attribute;
use Exception;

class AttributeService
{
    public function __construct(public AttributeInterface $repository)
    {
    }

    /**
     * @throws Exception
     */
    public function index(bool|null $trashed = false): mixed
    {
        return DatatableHelper::datatable($this->repository->attributes(['id', 'title', 'deleted_at'], [], $trashed));
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

    public function destroy($id): ?bool
    {
        return $this->repository->destroy($id);
    }

    public function restore(array $ids): bool
    {
        foreach ($ids as $id) {
            $this->repository->restore($id);
        }

        return true;
    }

    public function forceDelete(array $ids): bool
    {
        foreach ($ids as $id) {
            $this->repository->forceDelete($id);
        }

        return true;
    }
}
