<?php

namespace App\Http\Controllers\User\Relation\Role\ResourceCollection;

use App\Http\Controllers\User\Relation\Permission\Contract\PermissionInterface;
use App\Http\Controllers\User\Relation\Permission\ResourceCollection\PermissionRelationResourceCollection;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleEditResourceCollection extends JsonResource
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
            'name' => $this->name ?? null,
            'permissions' => PermissionRelationResourceCollection::collection($this->permissions ?? null),
            'permission_id' => PermissionRelationResourceCollection::collection(app()
                ->make(PermissionInterface::class)
                ->permissions())
        ];
    }
}