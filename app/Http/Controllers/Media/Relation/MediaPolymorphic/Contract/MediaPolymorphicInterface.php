<?php

namespace App\Http\Controllers\Media\Relation\MediaPolymorphic\Contract;

interface MediaPolymorphicInterface
{
    /**
     * @param $mediaId
     * @param $modelType
     * @param $modelId
     * @return mixed
     */
    public function store($mediaId, $modelType, $modelId): mixed;

    /**
     * @param $modelType
     * @param $modelId
     * @return mixed
     */
    public function destroy($modelType, $modelId): mixed;
}
