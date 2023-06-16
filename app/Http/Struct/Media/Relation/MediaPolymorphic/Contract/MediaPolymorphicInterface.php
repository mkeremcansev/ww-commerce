<?php

namespace App\Http\Struct\Media\Relation\MediaPolymorphic\Contract;

interface MediaPolymorphicInterface
{
    public function store($mediaId, $modelType, $modelId): mixed;

    public function destroy($modelType, $modelId): mixed;
}
