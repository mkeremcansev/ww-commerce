<?php

namespace App\Http\Controllers\Product\Relation\Brand\Service;

use App\Helpers\DatatableHelper;
use App\Http\Controllers\Product\Relation\Brand\Contract\BrandInterface;
use App\Http\Controllers\Product\Relation\Brand\Model\Brand;
use App\Http\Controllers\Product\Relation\Brand\ResourceCollection\BrandResourceCollection;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;
use Yajra\DataTables\DataTables;

class BrandService
{
    /**
     * @param BrandInterface $repository
     */
    public function __construct(public BrandInterface $repository)
    {
    }

    public function filters($query)
    {
        return collect(request()->all())->map(function ($value, $key) use ($query) {
            switch ($value) {
                case is_array($value):
                    $query->whereIn($key, $value);
                    break;
                case is_int($value):
                    $query->where($key, $value);
                    break;
                case is_string($value):
                    $query->where($key, 'LIKE', "%{$value}%");
                    break;
            }
        });
    }

    /**
     * @return AnonymousResourceCollection
     * @throws Exception
     */
    public function index(): AnonymousResourceCollection
    {
        return BrandResourceCollection::collection(DatatableHelper::datatable($this->repository->brands(['id', 'title', 'slug', 'path'])));
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
