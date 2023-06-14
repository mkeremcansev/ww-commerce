<?php

namespace App\Http\Controllers\Product\Relation\Category\Repository;

use App\Http\Controllers\Product\Relation\Category\Contract\CategoryInterface;
use App\Http\Controllers\Product\Relation\Category\Model\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\HigherOrderWhenProxy;

class CategoryRepository implements CategoryInterface
{
    /**
     * @param Category $model
     */
    public function __construct(public Category $model)
    {
    }

    /**
     * @param $id
     * @return Category|null
     */
    public function categoryById($id): ?Category
    {
        return $this->model
            ->whereId($id)
            ->first();
    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function categories(array $columns = []): mixed
    {
        return $this->model
            ->when(count($columns),
                fn($eloquent) => $eloquent->select($columns),
                fn($eloquent) => $eloquent->get()
            );
    }

    /**
     * @param array $columns
     * @return array|Builder[]|Collection|HigherOrderWhenProxy[]
     */
    public function mainCategoriesWithParents(array $columns = []): Collection|array
    {
        return $this->model
            ->main()
            ->with('parents')
            ->when(count($columns),
                fn($eloquent) => $eloquent->select($columns),
            )
            ->get();
    }

    /**
     * @param $title
     * @param $slug
     * @param $media
     * @param $category_id
     * @return mixed
     */
    public function store($title, $slug, $media, $category_id): mixed
    {
        $category = $this->model->create([
            'title' => $title,
            'slug' => $slug,
            'category_id' => $category_id
        ]);
        $this->attachMedia($category, $media);

        return $category;
    }

    /**
     * @param $id
     * @param $title
     * @param $slug
     * @param $media
     * @param $category_id
     * @return bool
     */
    public function update($id, $title, $slug, $media, $category_id): bool
    {
        $category = $this->categoryById($id);
        if ($category) {
            $this->destroyMedia($category);
            $this->attachMedia($category, $media);
            return $category->update([
                'title' => $title,
                'slug' => $slug,
                'category_id' => $category_id
            ]);
        }

        return false;
    }

    /**
     * @param Category $category
     * @param $media
     * @return void
     */
    public function attachMedia(Category $category, $media): void
    {
        $category->addMediaFromId($media['id']);
    }

    /**
     * @param Category $category
     * @return void
     */
    public function destroyMedia(Category $category): void
    {
        $category->destroyMedia();
    }

    /**
     * @param $id
     * @return bool
     */
    public function destroy($id): bool
    {
        $category = $this->categoryById($id);

        return $category && $category->delete();
    }

    /**
     * @param $title
     * @param $slug
     * @param $category_id
     * @return Category
     */
    public function firstOrCreate($title, $slug, $category_id): Category
    {
        return $this->model->firstOrCreate([
            'title' => $title,
            'slug' => $slug,
            'category_id' => $category_id
        ]);
    }
}
