<?php

namespace App\Http\Controllers\Product\Relation\Brand\Contract;

use App\Http\Controllers\Product\Relation\Brand\Model\Brand;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

interface BrandInterface
{
    /**
     * @param $title
     * @param $slug
     * @param $media
     * @return Brand
     */
    public function store($title, $slug, $media): Brand;

    /**
     * @param Brand $brand
     * @param $media
     * @return mixed
     */
    public function attachMedia(Brand $brand, $media): mixed;

    /**
     * @param $id
     * @param $title
     * @param $slug
     * @param $media
     * @return bool
     */
    public function update($id, $title, $slug, $media): bool;

    /**
     * @param Brand $brand
     * @return void
     */
    public function destroyMedia(Brand $brand): void;

    /**
     * @param $id
     * @return Brand|null
     */
    public function brandById($id): ?Brand;

    /**
     * @param array $columns
     * @return mixed
     */
    public function brands(array $columns = []): mixed;


    /**
     * @param $id
     * @return bool
     */
    public function destroy($id): bool;

    /**
     * @param $title
     * @param $slug
     * @return Brand
     */
    public function firstOrCreate($title, $slug): Brand;
}
