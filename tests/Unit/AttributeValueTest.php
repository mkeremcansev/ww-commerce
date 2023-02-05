<?php

namespace Tests\Unit;

use App\Http\Controllers\Product\Relation\Attribute\Model\Attribute;
use App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\Model\AttributeValue;
use Tests\TestCase;

class AttributeValueTest extends TestCase
{
    /**
     * @param string|null $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->model = resolve(AttributeValue::class);
        $this->parent_model = resolve(Attribute::class);
    }

    /**
     * @return void
     */
    public function test_can_index_attribute_value(): void
    {
        $this->assertIsObject($this->post(route('attribute.value.index'), [])->getOriginalContent());
    }

    /**
     * @return void
     */
    public function test_can_create_attribute_value(): void
    {
        $this->get(route('attribute.value.create'))->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_can_store_attribute_value(): void
    {
        $attribute = $this->post(route('attribute.store'), [
            'title' => $this->faker->colorName
        ])->assertStatus(200)->getOriginalContent();

        self::$parent_id = $attribute['data']['id'];

        $attribute_value = $this->post(route('attribute.value.store'), [
            'attribute_id' => self::$parent_id,
            'title' => $this->faker->colorName,
            'code' => $this->faker->colorName,
            'path' => $this->faker->imageUrl()
        ])->assertStatus(200)->getOriginalContent();

        self::$id = $attribute_value['data']['id'];
    }

    /**
     * @return void
     */
    public function test_can_edit_attribute_value(): void
    {
        $this->get(route('attribute.value.edit', self::$id))->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_can_update_attribute_value(): void
    {
        $this->patch(route('attribute.value.update', self::$id), [
            'attribute_id' => self::$parent_id,
            'title' => $this->faker->colorName,
            'code' => $this->faker->colorName,
            'path' => $this->faker->imageUrl()
        ])->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_can_destroy_attribute_value(): void
    {
       $this->delete(route('attribute.value.destroy', self::$id))->assertStatus(200);
       $this->delete(route('attribute.destroy', self::$parent_id))->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_can_force_brand(): void
    {
        $this->assertTrue($this->model->find(self::$id)->forceDelete());
        $this->assertTrue($this->parent_model->find(self::$parent_id)->forceDelete());
    }
}
