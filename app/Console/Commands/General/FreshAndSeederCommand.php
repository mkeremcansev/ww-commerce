<?php

namespace App\Console\Commands\General;

use App\Console\Commands\General\Enumeration\FreshAndSeedCommandEnumeration;
use App\Helpers\EnumerationHelper;
use App\Http\Controllers\User\Contract\UserInterface;
use App\Http\Controllers\User\Enumeration\UserRoleEnumeration;
use App\Http\Controllers\User\Service\UserService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use ReflectionException;

class FreshAndSeederCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fresh:seed';

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
     * @throws ReflectionException
     */
    public function handle(): void
    {
        $this->action($this->choice(
            __('words.areYouSureWantToResetTheDatabase'),
            EnumerationHelper::enumerationToArray(FreshAndSeedCommandEnumeration::class)
        ));
    }

    /**
     * @return void
     */
    public function freshAndSeed(): void
    {
        $this->callArtisanCommand('migrate:fresh --seed');
        $this->info(__('words.databaseMigratedAndSeeded'));
    }

    /**
     * @param $result
     */
    public function action($result)
    {
        match ($result) {
            FreshAndSeedCommandEnumeration::YES => $this->freshAndSeed(),
            FreshAndSeedCommandEnumeration::NO => $this->info(__('words.databaseNotFreshedAndSeeded')),
        };
    }

    /**
     * @param string $command
     * @return int
     */
    public function callArtisanCommand(string $command): int
    {
        return Artisan::call($command);
    }
}
