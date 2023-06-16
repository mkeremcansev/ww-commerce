<?php

namespace App\Http\Struct\User\Collection;

use Illuminate\Http\Resources\Json\JsonResource;

class UserIndexCollection extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? null,
            'name' => $this->name ?? null,
            'email' => $this->email ?? null,
        ];
    }
}
