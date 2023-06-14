<?php

namespace App\Http\Controllers\User\Relation\Role\Resource;

use App\Http\Controllers\User\Relation\Role\Collection\RoleIndexCollection;
use App\Traits\DatatableCollectionTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleIndexResource extends JsonResource
{
    use DatatableCollectionTrait;

    public function toArray($request): array
    {
        return [
            'data' => RoleIndexCollection::collection($this->data ?? null),
        ]
            +
            $this->datatables($this);
    }
}
