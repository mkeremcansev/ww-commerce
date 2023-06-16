<?php

namespace App\Http\Struct\User\ResourceCollection;

use App\Http\Struct\User\Relation\Role\Contract\RoleInterface;
use App\Http\Struct\User\Relation\Role\ResourceCollection\RoleRelationResourceCollection;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Resources\Json\JsonResource;

class UserEditResourceCollection extends JsonResource
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
            'email' => $this->email ?? null,
            'roles' => RoleRelationResourceCollection::collection($this->roles ?? null),
            'role_id' => RoleRelationResourceCollection::collection(resolve(RoleInterface::class)
                ->roles()),
        ];
    }
}
