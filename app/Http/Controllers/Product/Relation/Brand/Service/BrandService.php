<?php

namespace App\Http\Controllers\Product\Relation\Brand\Service;

use App\Helpers\DatatableHelper;
use App\Http\Controllers\Product\Relation\Brand\Contract\BrandInterface;
use App\Http\Controllers\Product\Relation\Brand\Model\Brand;
use Exception;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

class BrandService
{
    /**
     * @param BrandInterface $repository
     */
    public function __construct(public BrandInterface $repository)
    {
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function index(): mixed
    {
        return DatatableHelper::datatable($this->repository->brands(['id', 'title', 'slug', 'path']));
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
