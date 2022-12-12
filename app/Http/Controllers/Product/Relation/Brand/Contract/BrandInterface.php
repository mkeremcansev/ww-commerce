<?php

namespace App\Http\Controllers\Product\Relation\Brand\Contract;

use App\Http\Controllers\Product\Relation\Brand\Model\Brand;
use Illuminate\Support\Collection;

interface BrandInterface
{
    /**
     * @param $title
     * @param $slug
     * @param $path
     * @return Brand
     */
    public function store($title, $slug, $path): Brand;

    /**
     * @param $id
     * @param $title
     * @param $slug
     * @param $path
     * @return bool
     */
    public function update($id, $title, $slug, $path): bool;

    /**
     * @param $id
     * @return Brand|null
     */
    public function brandById($id): ?Brand;

    /**
     * @return Collection
     */
    public function brands(): Collection;


    /**
     * @param $id
     * @return bool
     */
    public function destroy($id): bool;
}
