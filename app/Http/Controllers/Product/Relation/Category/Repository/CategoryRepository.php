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
     * @param $path
     * @param $category_id
     * @return mixed
     */
    public function store($title, $slug, $path, $category_id): mixed
    {
        return $this->model->create([
            'title' => $title,
            'slug' => $slug,
            'path' => $path,
            'category_id' => $category_id
        ]);
    }

    /**
     * @param $id
     * @param $title
     * @param $slug
     * @param $path
     * @param $category_id
     * @return bool
     */
    public function update($id, $title, $slug, $path, $category_id): bool
    {
        $category = $this->categoryById($id);

        return $category && $category->update([
                'title' => $title,
                'slug' => $slug,
                'path' => $path,
                'category_id' => $category_id
            ]);
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
}
