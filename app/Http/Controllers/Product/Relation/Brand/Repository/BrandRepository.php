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
}
