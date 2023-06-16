<?php

namespace App\Http\Struct\User\Resource;

use App\Http\Struct\User\Collection\UserIndexCollection;
use App\Traits\DatatableCollectionTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class UserIndexResource extends JsonResource
{
    use DatatableCollectionTrait;

    public function toArray($request): array
    {
        return [
            'data' => UserIndexCollection::collection($this->data ?? null),
        ]
            +
            $this->datatables($this);
    }
}
