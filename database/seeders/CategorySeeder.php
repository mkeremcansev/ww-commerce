<?php

namespace Database\Seeders;

use App\Http\Controllers\Product\Relation\Category\Contract\CategoryInterface;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->firstOrCreate('Electronics', [
            ['title' => 'Mobile Phones'],
            ['title' => 'Laptops'],
            ['title' => 'Tablets'],
            ['title' => 'TV & Audio'],
            ['title' => 'Cameras'],
            ['title' => 'Accessories'],
        ]);
    }

    public function firstOrCreate($title, array $parents): void
    {
        $category = resolve(CategoryInterface::class)
            ->firstOrCreate($title, Str::slug($title), null);

        foreach ($parents as $parent) {
            $category->parents()
                ->firstOrCreate([
                    'title' => $parent['title'],
                    'slug' => Str::slug($parent['title']),
                ]);
        }
    }
}
