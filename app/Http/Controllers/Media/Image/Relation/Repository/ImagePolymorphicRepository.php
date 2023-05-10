<?php

namespace App\Http\Controllers\Media\Image\Relation\Repository;

use App\Http\Controllers\Media\Image\Relation\Contract\ImagePolymorphicInterface;
use App\Http\Controllers\Media\Image\Relation\Model\ImagePolymorphic;
use Illuminate\Database\Eloquent\Collection;

class ImagePolymorphicRepository implements ImagePolymorphicInterface
{
    /**
     * @param ImagePolymorphic $model
     */
    public function __construct(public ImagePolymorphic $model)
    {
    }

    /**
     * @param $modelType
     * @param $modelId
     * @return array|Collection
     */
    public function images($modelType, $modelId): array|Collection
    {
        return $this->model
            ->with('images')
            ->where('model_type', $modelType)
            ->where('model_id', $modelId)
            ->get();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function imagePolymorphicById(int $id): mixed
    {
        return $this->model->first($id);
    }
}
