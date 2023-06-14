<?php

namespace App\Http\Controllers\Media\Relation\MediaPolymorphic\Trait;

use App\Http\Controllers\Media\Model\Media;
use App\Http\Controllers\Media\Relation\MediaPolymorphic\Contract\MediaPolymorphicInterface;
use App\Http\Controllers\Media\Relation\MediaPolymorphic\Model\MediaPolymorphic;
use Illuminate\Database\Eloquent\Collection;

trait MediaPolymorphicTrait
{
    /**
     * @param $mediaId
     * @return mixed
     */
    public function addMediaFromId($mediaId): mixed
    {
        return resolve(MediaPolymorphicInterface::class)
            ->store($mediaId, self::class, $this->id);
    }

    /**
     * @return mixed
     */
    public function destroyMedia(): mixed
    {
        return resolve(MediaPolymorphicInterface::class)
            ->destroy(self::class, $this->id);
    }

    /**
     * @return Collection
     */
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
