<?php

namespace App\Http\Controllers\User\Relation\Permission\ResourceCollection;

use Illuminate\Http\Resources\Json\JsonResource;

class PermissionRelationResourceCollection extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? null,
            'name' => $this->name ?? null,
            'group_name' => $this->group_name ?? null,
        ];
    }
}
