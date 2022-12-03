<?php

namespace App\Http\Controllers\Product\Relation\Category\Contract;

use Illuminate\Database\Eloquent\Collection;

interface CategoryInterface
{
    /**
     * @return Collection|array
     */
    public function categories(): Collection|array;
}
