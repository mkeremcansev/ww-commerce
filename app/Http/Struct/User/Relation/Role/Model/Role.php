<?php

namespace App\Http\Struct\User\Relation\Role\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();
    }
}
