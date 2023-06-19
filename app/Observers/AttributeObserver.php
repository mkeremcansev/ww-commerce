<?php

namespace App\Observers;

use App\Http\Struct\Product\Relation\Attribute\Model\Attribute;

class AttributeObserver
{
    /**
     * Handle the Attribute "created" event.
     */
    public function created(Attribute $attribute): void
    {
        //
    }

    /**
     * Handle the Attribute "updated" event.
     */
    public function updated(Attribute $attribute): void
    {
        //
    }

    /**
     * Handle the Attribute "deleting" event.
     */
    public function deleting(Attribute $attribute): void
    {
        $attribute->values()->each(fn ($value) => $value->delete());
    }

    /**
     * Handle the Attribute "restoring" event.
     */
    public function restoring(Attribute $attribute): void
    {
        $attribute->values()->onlyTrashed()->each(fn ($value) => $value->restore());
    }

    /**
     * Handle the Attribute "force deleting" event.
     */
    public function forceDeleting(Attribute $attribute): void
    {
        $attribute->values()->onlyTrashed()->each(fn ($value) => $value->forceDelete());
    }
}
