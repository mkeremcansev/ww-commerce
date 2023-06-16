<?php

namespace App\Http\Struct\Product\Relation\Attribute\Relation\AttributeValue\ResourceCollection;

use App\Http\Struct\Product\Relation\Attribute\Contract\AttributeInterface;
use App\Http\Struct\Product\Relation\Attribute\ResourceCollection\AttributeResourceCollection;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Resources\Json\JsonResource;

class AttributeValueEditResourceCollection extends JsonResource
{
    /**
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
