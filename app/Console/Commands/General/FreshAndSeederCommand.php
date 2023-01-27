<?php

namespace App\Console\Commands\General;

use App\Http\Controllers\User\Contract\UserInterface;
use App\Http\Controllers\User\Enumeration\UserRoleEnumeration;
use App\Http\Controllers\User\Service\UserService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

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
     */
    public function handle(): void
    {
        $this->action($this->getAskEmail(), $this->getSecretPassword());
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
     * @param array|string $email
     * @param mixed $password
     * @return void
     */
    public function action(array|string $email, mixed $password): void
    {
        resolve(UserService::class)->user($email, $password)
            ? $this->freshAndSeed()
            : $this->error(__('words.invalidAuthorizationInformation'));
    }

    /**
     * @return mixed
     */
    public function getAskEmail(): mixed
    {
        return $this->ask(__('words.whichUserWillYouLogInWith'));
    }

    /**
     * @return mixed
     */
    public function getSecretPassword(): mixed
    {
        return $this->secret(__('words.enterPassword'));
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
