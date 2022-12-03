<?php

namespace App\Http\Controllers\Product\Relation\Category\Repository;

use App\Http\Controllers\Product\Relation\Category\Contract\CategoryInterface;
use App\Http\Controllers\Product\Relation\Category\Model\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryInterface
{
    /**
     * @param Category $model
     */
    public function __construct(public Category $model)
    {
    }

    /**
     * @return Builder[]|Collection
     */
    public function categories(): Collection|array
    {
        return $this->model
            ->with('parents')
            ->main()
            ->get();
    }
}
