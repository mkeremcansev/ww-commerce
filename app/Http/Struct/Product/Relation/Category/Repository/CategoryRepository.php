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

    public function store($title, $slug, $media, $category_id): mixed
    {
        $category = $this->model->create([
            'title' => $title,
            'slug' => $slug,
            'category_id' => $category_id,
        ]);
        $this->attachMedia($category, $media);

        return $category;
    }

    public function update($id, $title, $slug, $media, $category_id): bool
    {
        $category = $this->categoryById($id);
        if ($category) {
            $this->destroyMedia($category);
            $this->attachMedia($category, $media);

            return $category->update([
                'title' => $title,
                'slug' => $slug,
                'category_id' => $category_id,
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

    public function firstOrCreate($title, $slug, $category_id): Category
    {
        return $this->model->firstOrCreate([
            'title' => $title,
            'slug' => $slug,
            'category_id' => $category_id,
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
