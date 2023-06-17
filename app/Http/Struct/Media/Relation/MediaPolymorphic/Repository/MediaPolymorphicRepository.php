<?php

namespace App\Http\Struct\Media\Relation\MediaPolymorphic\Repository;

use App\Http\Struct\Media\Relation\MediaPolymorphic\Contract\MediaPolymorphicInterface;
use App\Http\Struct\Media\Relation\MediaPolymorphic\Model\MediaPolymorphic;

class MediaPolymorphicRepository implements MediaPolymorphicInterface
{
    public function __construct(public MediaPolymorphic $model)
    {
    }

    public function store($mediaId, $modelType, $modelId): mixed
    {
        return $this->model->firstOrCreate([
            'media_id' => $mediaId,
            'model_type' => $modelType,
            'model_id' => $modelId,
        ]);
    }

    public function destroy($modelType, $modelId): mixed
    {
        return $this->model
            ->where([
                'model_type' => $modelType,
                'model_id' => $modelId,
            ])
            ?->delete();
    }

    public function forceDestroy($modelType, $modelId): mixed
    {
        return $this->model
            ->withTrashed()
            ->where([
                'model_type' => $modelType,
                'model_id' => $modelId,
            ])
            ?->forceDelete();
    }
}
