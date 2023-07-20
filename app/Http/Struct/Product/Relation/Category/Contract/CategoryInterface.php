<?php

namespace App\Http\Struct\Product\Relation\Category\Contract;

use App\Http\Struct\Product\Relation\Category\Model\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryInterface
{
    public function categoryById($id, $trashed = false): ?Category;

    public function categories(array $columns = [], bool|null $trashed = false): mixed;

    public function mainCategoriesWithParents(array $columns = []): Collection|array;

    public function store($title, $slug, $media, $categoryId, $attributeIds): mixed;

    public function attachAttributes(Category $category, $attributeIds): void;

    public function update($id, $title, $slug, $media, $categoryId, $attributeIds): bool;

    public function attachMedia(Category $category, $media): void;

    public function destroyMedia(Category $category): void;

    public function destroy($id): ?bool;

    public function firstOrCreate($title, $slug, $categoryId): Category;
}
