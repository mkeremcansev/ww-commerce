<?php

namespace App\Http\Struct\Product\Relation\Category\Repository;

use App\Http\Struct\Product\Relation\Category\Contract\CategoryInterface;
use App\Http\Struct\Product\Relation\Category\Model\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\HigherOrderWhenProxy;

class CategoryRepository implements CategoryInterface
{
    public function __construct(public Category $model)
    {
    }

    public function categoryById($id, $trashed = false): ?Category
    {
        return $this->model
            ->when($trashed, fn ($query) => $query->onlyTrashed())
            ->whereId($id)
            ->first();
    }

    public function categories(array $columns = [], bool|null $trashed = false): mixed
    {
        return $this->model
            ->when($trashed, fn ($query) => $query->onlyTrashed())
            ->when(count($columns),
                fn ($eloquent) => $eloquent->select($columns),
                fn ($eloquent) => $eloquent->get()
            );
    }

    /**
     * @return array|Builder[]|Collection|HigherOrderWhenProxy[]
     */
    public function mainCategoriesWithParents(array $columns = []): Collection|array
    {
        return $this->model
            ->main()
            ->with('parents')
            ->when(count($columns),
                fn ($eloquent) => $eloquent->select($columns),
            )
            ->get();
    }

    public function store($title, $slug, $media, $categoryId, $attributeIds): mixed
    {
        $category = $this->model->create([
            'title' => $title,
            'slug' => $slug,
            'category_id' => $categoryId,
        ]);
        $this->attachMedia($category, $media);
        $this->attachAttributes($category, $attributeIds);

        return $category;
    }

    public function attachAttributes(Category $category, $attributeIds): void
    {
        $category->attributes()->attach($attributeIds);
    }

    public function update($id, $title, $slug, $media, $categoryId, $attributeIds): bool
    {
        $category = $this->categoryById($id);
        if ($category) {
            $category->touch();
            $this->destroyMedia($category);
            $this->attachMedia($category, $media);
            $this->attachAttributes($category, $attributeIds);

            return $category->update([
                'title' => $title,
                'slug' => $slug,
                'category_id' => $categoryId,
            ]);
        }

        return false;
    }

    public function attachMedia(Category $category, $media): void
    {
        $category->addMediaFromId($media['id']);
    }

    public function destroyMedia(Category $category): void
    {
        $category->destroyMedia();
    }

    public function destroy($id): ?bool
    {
        $category = $this->categoryById($id);

        return $category?->delete();
    }

    public function firstOrCreate($title, $slug, $categoryId): Category
    {
        return $this->model->firstOrCreate([
            'title' => $title,
            'slug' => $slug,
            'category_id' => $categoryId,
        ]);
    }

    public function restore($id): ?bool
    {
        $category = $this->categoryById($id, true);

        return $category?->restore();
    }

    public function forceDelete($id): ?bool
    {
        $category = $this->categoryById($id, true);

        return $category?->forceDelete();
    }
}
