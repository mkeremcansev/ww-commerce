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
}
