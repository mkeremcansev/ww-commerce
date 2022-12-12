<?php

namespace App\Http\Controllers\Product\Relation\Brand\Service;

use App\Http\Controllers\Product\Relation\Brand\Contract\BrandInterface;
use App\Http\Controllers\Product\Relation\Brand\Model\Brand;
use Illuminate\Support\Collection;

class BrandService
{
    /**
     * @param BrandInterface $repository
     */
    public function __construct(public BrandInterface $repository)
    {
    }

    /**
     * @return Collection
     */
    public function index(): Collection
    {
        return $this->repository->brands();
    }

    /**
     * @param $title
     * @param $slug
     * @param $path
     * @return Brand
     */
    public function store($title, $slug, $path): Brand
    {
        return $this->repository->store($title, $slug, $path);
    }

    /**
     * @param $id
     * @return Brand|null
     */
    public function edit($id): ?Brand
    {
        return $this->repository->brandById($id);
    }

    /**
     * @param $id
     * @param $title
     * @param $slug
     * @param $path
     * @return bool
     */
    public function update($id, $title, $slug, $path): bool
    {
        return $this->repository->update($id, $title, $slug, $path);
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
