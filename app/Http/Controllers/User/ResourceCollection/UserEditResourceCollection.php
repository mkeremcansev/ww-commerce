<?php

namespace App\Http\Controllers\User\ResourceCollection;

use App\Http\Controllers\User\Relation\Role\Contract\RoleInterface;
use App\Http\Controllers\User\Relation\Role\ResourceCollection\RoleRelationResourceCollection;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Resources\Json\JsonResource;

class UserEditResourceCollection extends JsonResource
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
            'email' => $this->email ?? null,
            'roles' => RoleRelationResourceCollection::collection($this->roles ?? null),
            'role_id' => RoleRelationResourceCollection::collection(app()
                ->make(RoleInterface::class)
                ->roles())
        ];
    }
}
