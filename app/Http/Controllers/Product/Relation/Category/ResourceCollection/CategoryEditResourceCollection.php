<?php

namespace App\Http\Controllers\Product\Relation\Category\ResourceCollection;

use App\Http\Controllers\Product\Relation\Category\Contract\CategoryInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryEditResourceCollection extends JsonResource
{
    /**
     * @throws BindingResolutionException
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? null,
            'title' => $this->title ?? null,
            'slug' => $this->slug ?? null,
            'media' => $this->firstMedia() ?? null,
            'category_id' => $this->category_id ?? null,
            'categories' => CategoryCreateResourceCollection::collection(resolve(CategoryInterface::class)
                ->mainCategoriesWithParents(['id', 'title', 'slug'])),
        ];
    }
}
