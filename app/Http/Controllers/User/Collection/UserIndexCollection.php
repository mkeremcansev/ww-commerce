<?php

namespace App\Http\Controllers\User\Collection;

use Illuminate\Http\Resources\Json\JsonResource;

class UserIndexCollection extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? null,
            'name' => $this->name ?? null,
            'email' => $this->email ?? null
        ];
    }
}
