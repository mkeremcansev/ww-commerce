<?php

namespace App\Http\Controllers\User\Relation\Role\ResourceCollection;

use App\Http\Controllers\User\Relation\Permission\Contract\PermissionInterface;
use App\Http\Controllers\User\Relation\Permission\ResourceCollection\PermissionRelationResourceCollection;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleEditResourceCollection extends JsonResource
{
    /**
     * @throws BindingResolutionException
     */
    public function toArray($request): array
    {
        self::withoutWrapping();

        return [
            'id' => $this->id ?? null,
            'name' => $this->name ?? null,
            'permissions' => PermissionRelationResourceCollection::collection($this->permissions ?? null),
            'permission_id' => PermissionRelationResourceCollection::collection(resolve(PermissionInterface::class)
                ->permissions()),
        ];
    }
}
