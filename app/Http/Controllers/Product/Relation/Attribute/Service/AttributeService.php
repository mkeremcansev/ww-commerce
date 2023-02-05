<?php

namespace App\Http\Controllers\Product\Relation\Attribute\Service;

use App\Helpers\DatatableHelper;
use App\Http\Controllers\Product\Relation\Attribute\Contract\AttributeInterface;
use App\Http\Controllers\Product\Relation\Attribute\Model\Attribute;
use Exception;

class AttributeService
{
    /**
     * @param AttributeInterface $repository
     */
    public function __construct(public AttributeInterface $repository)
    {
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function index(): mixed
    {
        return DatatableHelper::datatable($this->repository->attributes(['id', 'title']));
    }

    /**
     * @param $title
     * @return Attribute
     */
    public function store($title): Attribute
    {
        return $this->repository->store($title);
    }

    /**
     * @param $id
     * @return Attribute|null
     */
    public function edit($id): ?Attribute
    {
        return $this->repository->attributeById($id);
    }

    /**
     * @param $id
     * @param $title
     * @return bool
     */
    public function update($id, $title): bool
    {
        return $this->repository->update($id, $title);
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
