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
        return DatatableHelper::datatable($this->repository->brands(['id', 'title', 'slug']));
    }

    /**
     * @param $title
     * @param $slug
     * @param $media
     * @return Brand
     */
    public function store($title, $slug, $media): Brand
    {
        return $this->repository->store($title, $slug, $media);
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
     * @param $media
     * @return bool
     */
    public function update($id, $title, $slug, $media): bool
    {
        return $this->repository->update($id, $title, $slug, $media);
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
