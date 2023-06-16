<?php

namespace App\Http\Struct\User\ResourceCollection;

use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileEditResourceCollection extends JsonResource
{
    public function toArray($request): array
    {
        self::withoutWrapping();

        return [
            'id' => $this->id ?? null,
            'name' => $this->name ?? null,
            'email' => $this->email ?? null,
        ];
    }
}
