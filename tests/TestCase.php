<?php

namespace Tests;

use App\Http\Controllers\User\Enumeration\UserRoleEnumeration;
use App\Http\Controllers\User\Model\User;
use App\Http\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Spatie\Permission\Middlewares\PermissionMiddleware;
use Spatie\Permission\Middlewares\RoleMiddleware;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * @var int $id
     */
    public static int $id;

    /**
     * @var Model $model
     */
    public Model $model;

    public Model $user;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->user = resolve(User::class);
        $this->be($this->user());
    }

    /**
     * @return User
     */
    public function user(): User
    {
        return $this->user->role(UserRoleEnumeration::ADMINISTRATOR_ROLE)->first();
    }
}
