<?php

namespace App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\ResourceCollection;

use App\Http\Controllers\Media\MediaResourceCollection;
use App\Http\Controllers\Product\Relation\Attribute\Contract\AttributeInterface;
use App\Http\Controllers\Product\Relation\Attribute\ResourceCollection\AttributeResourceCollection;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Resources\Json\JsonResource;

class AttributeValueEditResourceCollection extends JsonResource
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
            'code' => $this->code ?? null,
            'media' => $this->firstMedia() ?? null,
            'attribute_id' => $this->attribute_id ?? null,
            'attributes' => AttributeResourceCollection::collection(resolve(AttributeInterface::class)
            ->attributes()),
        ];
    }
}
