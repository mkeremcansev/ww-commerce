<?php

namespace App\Http\Controllers\Media;

use Illuminate\Http\Resources\Json\JsonResource;

class MediaResourceCollection extends JsonResource
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
            'full_path' => $this->getFullPath() ?? null,
            'extension' => $this->extension ?? null,
            'mime_type' => $this->mime_type ?? null,
            'size' => $this->size ?? null,
        ];
    }
}
