<?php

namespace App\Observers;

use App\Http\Struct\User\Relation\Role\Model\Role;

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
        $role->users()->detach();
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
        $role->users()->detach();
        $role->permissions()->detach();
    }
}
