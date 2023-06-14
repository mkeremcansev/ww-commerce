<?php

namespace App\Http\Controllers\Product\Relation\Brand\Repository;

use App\Http\Controllers\Product\Relation\Brand\Contract\BrandInterface;
use App\Http\Controllers\Product\Relation\Brand\Model\Brand;

class BrandRepository implements BrandInterface
{
    public function __construct(public Brand $model)
    {
    }

    public function store($title, $slug, $media): Brand
    {
        $brand = $this->model
            ->create([
                'title' => $title,
                'slug' => $slug,
            ]);
        $this->attachMedia($brand, $media);

        return $brand;
    }

    public function attachMedia(Brand $brand, $media): mixed
    {
        return $brand
            ->addMediaFromId($media['id']);
    }

    public function update($id, $title, $slug, $media): bool
    {
        $brand = $this->brandById($id);
        if ($brand) {
            $this->destroyMedia($brand);
            $this->attachMedia($brand, $media);

            return $brand->update([
                'title' => $title,
                'slug' => $slug,
            ]);
        }

        return false;
    }

    public function destroyMedia(Brand $brand): void
    {
        $brand->destroyMedia();
    }

    public function brandById($id): ?Brand
    {
        return $this->model
            ->whereId($id)
            ->first();
    }

    public function brands(array $columns = []): mixed
    {
        return $this->model
            ->when(count($columns),
                fn ($eloquent) => $eloquent->select($columns),
                fn ($eloquent) => $eloquent->get()
            );
    }

    public function destroy($id): bool
    {
        $brand = $this->brandById($id);

        return $brand && $brand->delete();
    }

    /**
     * @param $path
     */
    public function firstOrCreate($title, $slug): Brand
    {
        return $this->model
            ->firstOrCreate([
                'title' => $title,
                'slug' => $slug,
            ]);
    }
}
