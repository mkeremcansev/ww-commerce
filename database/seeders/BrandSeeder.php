<?php

namespace Database\Seeders;

use App\Http\Controllers\Product\Relation\Brand\Contract\BrandInterface;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->firstOrCreate('Apple');
    }

    public function firstOrCreate(string $title): void
    {
        resolve(BrandInterface::class)
            ->firstOrCreate($title, Str::slug($title));
    }
}
