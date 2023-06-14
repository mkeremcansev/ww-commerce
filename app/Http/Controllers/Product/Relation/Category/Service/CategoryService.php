<?php

namespace App\Http\Controllers\Product\Relation\Category\Service;

use App\Helpers\DatatableHelper;
use App\Http\Controllers\Product\Relation\Category\Contract\CategoryInterface;
use App\Http\Controllers\Product\Relation\Category\Model\Category;
use Exception;
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
     * @throws Exception
     */
    public function index(): mixed
    {
        return DatatableHelper::datatable($this->repository->categories(['id', 'title', 'slug']));
    }

    /**
     * @return array|Collection
     */
    public function create(): Collection|array
    {
        return $this->repository->mainCategoriesWithParents(['id', 'title', 'slug']);
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
        return $this->repository->store($title, $slug, $media, $category_id);
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
     * @param $media
     * @param $category_id
     * @return mixed
     */
    public function update($id, $title, $slug, $media, $category_id): mixed
    {
        return $this->repository->update($id,$title, $slug, $media, $category_id);
    }

    /**
     * @param $id
     * @return bool
     */
    public function destroy($id): bool
    {
        return $this->repository->destroy($id);
    }
}
