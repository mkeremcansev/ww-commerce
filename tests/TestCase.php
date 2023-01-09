<?php

namespace Tests;

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

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware([
            Authenticate::class,
            RoleMiddleware::class,
            PermissionMiddleware::class,
        ]);
    }
}
