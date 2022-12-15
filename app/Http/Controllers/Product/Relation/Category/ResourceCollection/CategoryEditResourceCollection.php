<?php

namespace App\Http\Controllers\Product\Relation\Category\ResourceCollection;

use App\Http\Controllers\Product\Relation\Category\Contract\CategoryInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryEditResourceCollection extends JsonResource
{
    /**
     * @param $request
     * @return array
     * @throws BindingResolutionException
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? null,
            'title' => $this->title ?? null,
            'slug' => $this->slug ?? null,
            'path' => asset($this->path ?? null),
            'category_id' => $this->category_id ?? null,
            'categories' => CategoryCreateResourceCollection::collection(app()
                ->make(CategoryInterface::class)
                ->mainCategoriesWithParents(['id', 'title', 'slug', 'path']))
        ];
    }
}
