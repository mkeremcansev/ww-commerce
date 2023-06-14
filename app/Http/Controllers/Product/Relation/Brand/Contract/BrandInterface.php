<?php

namespace App\Http\Controllers\Product\Relation\Brand\Contract;

use App\Http\Controllers\Product\Relation\Brand\Model\Brand;

interface BrandInterface
{
    public function store($title, $slug, $media): Brand;

    public function attachMedia(Brand $brand, $media): mixed;

    public function update($id, $title, $slug, $media): bool;

    public function destroyMedia(Brand $brand): void;

    public function brandById($id): ?Brand;

    public function brands(array $columns = []): mixed;

    public function destroy($id): bool;

    public function firstOrCreate($title, $slug): Brand;
}
