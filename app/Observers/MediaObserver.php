<?php

namespace App\Observers;

use App\Http\Struct\Media\Model\Media;

class MediaObserver
{
    /**
     * Handle the Media "created" event.
     */
    public function created(Media $media): void
    {
        //
    }

    /**
     * Handle the Media "updated" event.
     */
    public function updated(Media $media): void
    {
        //
    }

    /**
     * Handle the Media "deleting" event.
     */
    public function deleting(Media $media): void
    {
        $media->items()->delete();
    }

    /**
     * Handle the Media "restoring" event.
     */
    public function restoring(Media $media): void
    {
        $media->items()->restore();
    }

    /**
     * Handle the Media "force deleting" event.
     */
    public function forceDeleting(Media $media): void
    {
        unlink(public_path($media->path_info).$media->path);
        $media->items()->forceDelete();
    }
}
