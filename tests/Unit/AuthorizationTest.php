<?php

namespace Tests\Unit;

use Tests\AuthorizationTestCase;

class AuthorizationTest extends AuthorizationTestCase
{
    /**
     * @return void
     */
    public function test_can_login_unauthorized(): void
    {
        $this->post(route('user.authorization'), [
            'email' => $this->faker->email,
            'password' => $this->faker->password,
        ])->assertStatus(401);
    }

    /**
     * @return void
     */
    public function test_can_login_authorized(): void
    {
        $this->post(route('user.authorization'), [
            'email' =>'admin@ww-commerce.com',
            'password' => 'password',
        ])->assertStatus(200);
    }
}
