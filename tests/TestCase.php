<?php

namespace Tests;

use App\Http\Controllers\User\Enumeration\UserRoleEnumeration;
use App\Http\Controllers\User\Model\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, WithFaker;

    public static int $id;

    public static int $parent_id;

    public Model $model;

    public Model $parent_model;

    public Model|Application $user;

    protected static bool $seeded = false;

    public function setUp(): void
    {

        parent::setUp();
        if (! static::$seeded) {
            $this->artisan('migrate:refresh --seed');
            static::$seeded = true;
        }
        $this->user = resolve(User::class);
        $this->be($this->user());
    }

    public function user(): User
    {
        return $this->user->role(UserRoleEnumeration::ADMINISTRATOR_ROLE)->first();
    }
}
