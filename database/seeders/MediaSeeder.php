<?php

namespace Database\Seeders;

use App\Http\Struct\Media\Contract\MediaInterface;
use App\Http\Struct\Media\Enumeration\MediaPathEnumeration;
use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            resolve(MediaInterface::class)
                ->store(
                    fake()->filePath(),
                    fake()->fileExtension(),
                    fake()->mimeType(),
                    rand(1000, 3000),
                    MediaPathEnumeration::MEDIA_PATH
                );
        }
    }
}
