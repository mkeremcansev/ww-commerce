<?php

namespace Tests\Feature;

use Tests\TestCase;

class RoleTest extends TestCase
{
    public function test_can_index_role(): void
    {
        $this->assertIsObject($this->post(route('role.index'), [])->getOriginalContent());
    }

    public function test_can_create_role(): void
    {
        $this->get(route('role.create'))->assertStatus(200);
    }

    public function test_can_store_role(): void
    {
        $permissions = $this->get(route('role.create'))->getOriginalContent()['permission_id']->pluck('id')->toArray();
        $role = $this->post(route('role.store'), [
            'name' => $this->faker->domainName,
            'permission_id' => $permissions,
        ])->assertStatus(200)->getOriginalContent();
        self::$id = $role['data']['id'];
    }

    public function test_can_edit_role(): void
    {
        $this->get(route('role.edit', self::$id))->assertStatus(200);
    }

    public function test_can_update_role(): void
    {
        $permissions = $this->get(route('role.create'))->getOriginalContent()['permission_id']->pluck('id')->toArray();
        $this->patch(route('role.update', self::$id), [
            'name' => $this->faker->domainName,
            'permission_id' => $permissions,
        ])->assertStatus(200);
    }

    public function test_can_destroy_role(): void
    {
        $this->delete(route('role.destroy', self::$id))->assertStatus(200);
    }
}
