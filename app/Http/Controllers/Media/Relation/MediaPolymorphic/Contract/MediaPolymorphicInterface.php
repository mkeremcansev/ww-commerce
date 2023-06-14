<?php

namespace App\Http\Controllers\Media\Relation\MediaPolymorphic\Contract;

interface MediaPolymorphicInterface
{
    public function store($mediaId, $modelType, $modelId): mixed;

    public function destroy($modelType, $modelId): mixed;
}
