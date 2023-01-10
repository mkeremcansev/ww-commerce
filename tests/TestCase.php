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

    /**
     * @var int $id
     */
    public static int $id;

    /**
     * @var int $parent_id
     */
    public static int $parent_id;

    /**
     * @var Model $model
     */
    public Model $model;

    /**
     * @var Model $parent_model
     */
    public Model $parent_model;

    /**
     * @var Application|Model
     */
    public Model|Application $user;

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
