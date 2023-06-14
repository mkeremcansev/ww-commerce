<?php

namespace App\Http\Controllers\User\Relation\Role\Collection;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleIndexCollection extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? null,
            'name' => $this->name ?? null,
        ];
    }
}
