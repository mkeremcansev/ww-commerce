<?php

namespace App\Observers;

use Spatie\Permission\Models\Role;

class RoleObserver
{
    /**
     * Handle the Role "created" event.
     */
    public function created(Role $role): void
    {
        //
    }

    /**
     * Handle the Role "updated" event.
     */
    public function updated(Role $role): void
    {
        //
    }

    /**
     * Handle the Role "deleting" event.
     */
    public function deleting(Role $role): void
    {
        //
    }

    /**
     * Handle the Role "restoring" event.
     */
    public function restoring(Role $role): void
    {
        //
    }

    /**
     * Handle the Role "force deleting" event.
     */
    public function forceDeleting(Role $role): void
    {
        //
    }
}
