<?php

namespace App\Http\Controllers\Media\Image\Relation\Contract;

use Illuminate\Database\Eloquent\Collection;

interface ImagePolymorphicInterface
{
    /**
     * @param $modelType
     * @param $modelId
     * @return array|Collection
     */
    public function images($modelType, $modelId): array|Collection;

    /**
     * @param int $id
     * @return mixed
     */
    public function imagePolymorphicById(int $id): mixed;
}
