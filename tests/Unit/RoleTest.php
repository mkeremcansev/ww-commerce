<?php

namespace Tests\Unit;

use Illuminate\Support\Collection;
use Tests\TestCase;

class RoleTest extends TestCase
{
    /**
     * @return void
     */
    public function test_can_index_role(): void
    {
        $this->assertInstanceOf(Collection::class, $this->post(route('role.index'))->getOriginalContent());
    }

    /**
     * @return void
     */
    public function test_can_create_role(): void
    {
        $this->get(route('role.create'))->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_can_store_role(): void
    {
        $permissions = $this->get(route('role.create'))->getOriginalContent()['permission_id']->pluck('id')->toArray();
        $role = $this->post(route('role.store'), [
            'name' => $this->faker->domainName,
            'permission_id' => $permissions
        ])->assertStatus(200)->getOriginalContent();
        self::$id = $role['data']['id'];
    }

    /**
     * @return void
     */
    public function test_can_edit_role(): void
    {
        $this->get(route('role.edit', self::$id))->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_can_update_role(): void
    {
        $permissions = $this->get(route('role.create'))->getOriginalContent()['permission_id']->pluck('id')->toArray();
        $this->patch(route('role.update', self::$id), [
            'name' => $this->faker->domainName,
            'permission_id' => $permissions
        ])->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_can_destroy_role(): void
    {
        $this->delete(route('role.destroy', self::$id))->assertStatus(200);
    }
}
