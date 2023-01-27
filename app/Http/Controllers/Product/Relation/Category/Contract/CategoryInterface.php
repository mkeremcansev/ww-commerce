<?php

namespace App\Http\Controllers\Product\Relation\Category\Contract;

use App\Http\Controllers\Product\Relation\Category\Model\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

interface CategoryInterface
{
    /**
     * @param $id
     * @return Category|null
     */
    public function categoryById($id): ?Category;
    /**
     * @param array $columns
     * @return mixed
     */
    public function categories(array $columns = []): mixed;

    /**
     * @param array $columns
     * @return Collection|array
     */
    public function mainCategoriesWithParents(array $columns = []): Collection|array;

    /**
     * @param $title
     * @param $slug
     * @param $path
     * @param $category_id
     * @return mixed
     */
    public function store($title, $slug, $path, $category_id): mixed;

    /**
     * @param $id
     * @param $title
     * @param $slug
     * @param $path
     * @param $category_id
     * @return bool
     */
    public function update($id, $title, $slug, $path, $category_id): bool;

    /**
     * @param $id
     * @return bool
     */
    public function destroy($id): bool;

    /**
     * @param $title
     * @param $slug
     * @param $path
     * @param $category_id
     * @return Category
     */
    public function firstOrCreate($title, $slug, $path, $category_id): Category;
}
