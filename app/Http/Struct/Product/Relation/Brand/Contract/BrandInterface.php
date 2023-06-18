<?php

namespace App\Http\Struct\Product\Relation\Brand\Contract;

use App\Http\Struct\Product\Relation\Brand\Model\Brand;

interface BrandInterface
{
    public function store($title, $slug, $media): Brand;

    public function attachMedia(Brand $brand, $media): mixed;

    public function update($id, $title, $slug, $media): bool;

    public function destroyMedia(Brand $brand): void;

    public function brandById($id, $trashed = false): ?Brand;

    public function brands(array $columns = [], bool|null $trashed = false): mixed;

    public function destroy($id): ?bool;

    public function firstOrCreate($title, $slug): Brand;
}
