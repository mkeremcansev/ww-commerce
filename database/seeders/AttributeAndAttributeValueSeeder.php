<?php

namespace Database\Seeders;

use App\Http\Controllers\Product\Relation\Attribute\Contract\AttributeInterface;
use Illuminate\Database\Seeder;

class AttributeAndAttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->firstOrCreate('Color', ['Red', 'Green', 'Blue']);
        $this->firstOrCreate('Size', ['Small', 'Medium', 'Large']);
    }

    public function firstOrCreate(string $title, array $values): void
    {
        $attribute = resolve(AttributeInterface::class)
            ->firstOrCreate($title);
        foreach ($values as $value) {
            $attribute->values()
                ->firstOrCreate([
                    'title' => $value,
                    'code' => strtoupper($value),
                ]);
        }
    }
}
