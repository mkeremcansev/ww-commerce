<?php

namespace App\Http\Controllers\Product\Relation\Brand\Repository;

use App\Http\Controllers\Product\Relation\Brand\Contract\BrandInterface;
use App\Http\Controllers\Product\Relation\Brand\Model\Brand;

class BrandRepository implements BrandInterface
{
    /**
     * @param Brand $model
     */
    public function __construct(public Brand $model)
    {
    }

    /**
     * @param $title
     * @param $slug
     * @param $path
     * @return Brand
     */
    public function store($title, $slug, $path): Brand
    {
        return $this->model
            ->create([
                'title' => $title,
                'slug' => $slug,
                'path' => $path,
            ]);
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
        $brand = $this->brandById($id);

        return $brand && $brand->update([
                'title' => $title,
                'slug' => $slug,
                'path' => $path,
            ]);
    }

    /**
     * @param $id
     * @return Brand|null
     */
    public function brandById($id): ?Brand
    {
        return $this->model
            ->whereId($id)
            ->first();
    }

    /**
     * @param $id
     * @return bool
     */
    public function destroy($id): bool
    {
        $brand = $this->brandById($id);

        return $brand && $brand->delete();
    }
}
