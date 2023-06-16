<?php

namespace App\Http\Struct\User\Relation\Role\ResourceCollection;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResourceCollection extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? null,
            'name' => $this->name ?? null,
        ];
    }
}
