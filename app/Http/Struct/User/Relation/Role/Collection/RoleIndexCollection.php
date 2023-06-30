<?php

namespace App\Http\Struct\User\Relation\Role\Collection;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleIndexCollection extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? null,
            'name' => $this->name ?? null,
            'deleted_at' => $this->deleted_at ?? null,
        ];
    }
}
