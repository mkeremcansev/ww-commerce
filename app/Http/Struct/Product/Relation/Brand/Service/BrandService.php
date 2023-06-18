<?php

namespace App\Http\Struct\Product\Relation\Brand\Service;

use App\Helpers\DatatableHelper;
use App\Http\Struct\Product\Relation\Brand\Contract\BrandInterface;
use App\Http\Struct\Product\Relation\Brand\Model\Brand;
use Exception;

class BrandService
{
    public function __construct(public BrandInterface $repository)
    {
    }

    /**
     * @throws Exception
     */
    public function index(bool|null $trashed = false): mixed
    {
        return DatatableHelper::datatable($this->repository->brands(['id', 'title', 'slug', 'deleted_at'], $trashed));
    }

    public function store($title, $slug, $media): Brand
    {
        return $this->repository->store($title, $slug, $media);
    }

    public function edit($id): ?Brand
    {
        return $this->repository->brandById($id);
    }

    public function update($id, $title, $slug, $media): bool
    {
        return $this->repository->update($id, $title, $slug, $media);
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
