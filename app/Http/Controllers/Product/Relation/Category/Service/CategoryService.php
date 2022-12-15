<?php

namespace App\Http\Controllers\Product\Relation\Category\Service;

use App\Http\Controllers\Product\Relation\Category\Contract\CategoryInterface;
use App\Http\Controllers\Product\Relation\Category\Model\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    /**
     * @param CategoryInterface $repository
     */
    public function __construct(public CategoryInterface $repository)
    {
    }

    /**
     * @return mixed
     */
    public function index(): mixed
    {
        return $this->repository->categories(['id', 'title', 'slug', 'path']);
    }

    /**
     * @return array|Collection
     */
    public function create(): Collection|array
    {
        return $this->repository->mainCategoriesWithParents(['id', 'title', 'slug', 'path']);
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
        return $this->repository->store($title, $slug, $path, $category_id);
    }

    /**
     * @param $id
     * @return Category|null
     */
    public function edit($id): ?Category
    {
        return $this->repository->categoryById($id);
    }

    /**
     * @param $id
     * @param $title
     * @param $slug
     * @param $path
     * @param $category_id
     * @return mixed
     */
    public function update($id, $title, $slug, $path, $category_id): mixed
    {
        return $this->repository->update($id,$title, $slug, $path, $category_id);
    }
}
