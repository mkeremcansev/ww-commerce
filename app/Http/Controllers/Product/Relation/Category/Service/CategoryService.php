<?php

namespace App\Http\Controllers\Product\Relation\Category\Service;

use App\Helpers\DatatableHelper;
use App\Http\Controllers\Product\Relation\Category\Contract\CategoryInterface;
use App\Http\Controllers\Product\Relation\Category\Model\Category;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    public function __construct(public CategoryInterface $repository)
    {
    }

    /**
     * @throws Exception
     */
    public function index(): mixed
    {
        return DatatableHelper::datatable($this->repository->categories(['id', 'title', 'slug']));
    }

    public function create(): Collection|array
    {
        return $this->repository->mainCategoriesWithParents(['id', 'title', 'slug']);
    }

    public function store($title, $slug, $media, $category_id): mixed
    {
        return $this->repository->store($title, $slug, $media, $category_id);
    }

    public function edit($id): ?Category
    {
        return $this->repository->categoryById($id);
    }

    public function update($id, $title, $slug, $media, $category_id): mixed
    {
        return $this->repository->update($id, $title, $slug, $media, $category_id);
    }

    public function destroy($id): bool
    {
        return $this->repository->destroy($id);
    }
}
