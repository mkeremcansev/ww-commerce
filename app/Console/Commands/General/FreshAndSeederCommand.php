<?php

namespace App\Console\Commands\General;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class FreshAndSeederCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fresh:seeder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Database fresh and seed';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        Artisan::call('migrate:fresh --seed');
        $this->info('Database migrated and seeded.');
    }
}
