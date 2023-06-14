<?php

namespace App\Http\Controllers\Product\Relation\Category\Contract;

use App\Http\Controllers\Product\Relation\Category\Model\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryInterface
{
    public function categoryById($id): ?Category;

    public function categories(array $columns = []): mixed;

    public function mainCategoriesWithParents(array $columns = []): Collection|array;

    public function store($title, $slug, $media, $category_id): mixed;

    public function update($id, $title, $slug, $media, $category_id): bool;

    public function attachMedia(Category $category, $media): void;

    public function destroyMedia(Category $category): void;

    public function destroy($id): ?bool;

    public function firstOrCreate($title, $slug, $category_id): Category;
}
