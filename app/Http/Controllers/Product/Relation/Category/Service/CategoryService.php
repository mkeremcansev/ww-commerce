<?php

namespace App\Http\Controllers\Product\Relation\Category\Service;

use App\Http\Controllers\Product\Relation\Category\Contract\CategoryInterface;

class CategoryService
{
    /**
     * @param CategoryInterface $repository
     */
    public function __construct(public CategoryInterface $repository)
    {
    }

    public function index()
    {
        return $this->repository->categories(['id', 'title', 'slug', 'path']);
    }
}
