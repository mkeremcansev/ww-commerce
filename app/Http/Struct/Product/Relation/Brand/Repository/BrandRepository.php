<?php

namespace App\Http\Struct\Product\Relation\Brand\Repository;

use App\Http\Struct\Product\Relation\Brand\Contract\BrandInterface;
use App\Http\Struct\Product\Relation\Brand\Model\Brand;

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

    public function brandById($id, $trashed = false): ?Brand
    {
        return $this->model
            ->when($trashed, fn ($query) => $query->onlyTrashed())
            ->whereId($id)
            ->first();
    }

    public function brands(array $columns = [], bool|null $trashed = false): mixed
    {
        return $this->model
            ->when($trashed, fn ($query) => $query->onlyTrashed())
            ->when(count($columns),
                fn ($eloquent) => $eloquent->select($columns),
                fn ($eloquent) => $eloquent->get()
            );
    }

    public function destroy($id): ?bool
    {
        $brand = $this->brandById($id);

        return $brand?->delete();
    }

    public function firstOrCreate($title, $slug): Brand
    {
        return $this->model
            ->firstOrCreate([
                'title' => $title,
                'slug' => $slug,
            ]);
    }

    public function restore($id): ?bool
    {
        $brand = $this->brandById($id, true);

        return $brand?->restore();
    }

public function forceDelete($id): ?bool
{
        $brand = $this->brandById($id, true);

        return $brand?->forceDelete();
    }
}
