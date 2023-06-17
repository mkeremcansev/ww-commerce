<?php

namespace App\Http\Struct\Media\Relation\MediaPolymorphic\Trait;

use App\Http\Struct\Media\Model\Media;
use App\Http\Struct\Media\Relation\MediaPolymorphic\Contract\MediaPolymorphicInterface;
use App\Http\Struct\Media\Relation\MediaPolymorphic\Model\MediaPolymorphic;
use Illuminate\Database\Eloquent\Collection;

trait MediaPolymorphicTrait
{
    public function addMediaFromId($mediaId): mixed
    {
        return resolve(MediaPolymorphicInterface::class)
            ->store($mediaId, self::class, $this->id);
    }

    public function destroyMedia(): mixed
    {
        return resolve(MediaPolymorphicInterface::class)
            ->destroy(self::class, $this->id);
    }

    public function forceDestroyMedia()
    {
        return resolve(MediaPolymorphicInterface::class)
            ->forceDestroy(self::class, $this->id);
    }

    public function restoreMedia()
    {
        return resolve(MediaPolymorphicInterface::class)
            ->restore(self::class, $this->id);
    }

    public function getMedia(): Collection
    {
        return $this->morphToMany(
            Media::class,
            'model',
            MediaPolymorphic::class,
            'model_id',
            'media_id'
        )->get();
    }

    /**
     * @return mixed|null
     */
    public function firstMedia(): mixed
    {
        return $this->morphToMany(
            Media::class,
            'model',
            MediaPolymorphic::class,
            'model_id',
            'media_id'
        )->first();
    }
}
