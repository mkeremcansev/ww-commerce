<?php

namespace App\Http\Controllers\User\ResourceCollection;

use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileEditResourceCollection extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        self::withoutWrapping();

        return [
            'id' => $this->id ?? null,
            'name' => $this->name ?? null,
            'email' => $this->email ?? null
        ];
    }
}
