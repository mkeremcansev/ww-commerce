<?php

namespace App\Http\Controllers\Product\Relation\Category\Contract;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

interface CategoryInterface
{
    /**
     * @param array $columns
     * @return mixed
     */
    public function categories(array $columns = []): mixed;
}
