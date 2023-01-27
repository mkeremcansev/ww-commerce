<?php

namespace App\Console\Commands\General;

use App\Http\Controllers\User\Contract\UserInterface;
use App\Http\Controllers\User\Enumeration\UserRoleEnumeration;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

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
        $this->action($this->getChoiceEmail(), $this->getSecretPassword());
    }

    /**
     * @return void
     */
    public function freshAndSeed(): void
    {
        Artisan::call('migrate:fresh --seed');
        $this->info(__('words.databaseMigratedAndSeeded'));
    }

    /**
     * @param array|string $email
     * @param mixed $password
     * @return void
     */
    public function action(array|string $email, mixed $password): void
    {
        Auth::attempt(['email' => $email, 'password' => $password])
            ? $this->freshAndSeed()
            : $this->error(__('words.invalidAuthorizationInformation'));
    }

    /**
     * @return array|string
     */
    public function getChoiceEmail(): string|array
    {
        return $this->choice(__('words.whichUserWillYouLogInWith'), resolve(UserInterface::class)
            ->usersByRoleName([UserRoleEnumeration::ADMINISTRATOR_ROLE])
            ->pluck('email')
            ->toArray());
    }

    /**
     * @return mixed
     */
    public function getSecretPassword(): mixed
    {
        return $this->secret(__('words.enterPassword'));
    }
}
