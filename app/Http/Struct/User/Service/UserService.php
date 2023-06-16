<?php

namespace App\Http\Struct\User\Service;

use App\Helpers\DatatableHelper;
use App\Http\Struct\User\Contract\UserInterface;
use App\Http\Struct\User\Model\User;
use Exception;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function __construct(public UserInterface $repository, public Auth $auth)
    {
    }

    /**
     * @throws Exception
     */
    public function index(): mixed
    {
        return DatatableHelper::datatable($this->repository->users(['id', 'name', 'email']));
    }

    public function authorization($email, $password): bool|string
    {
        $user = $this->attemptUser($email, $password);

        return $user ? $this->createToken($user) : false;
    }

    public function logout(): bool
    {
        $user = $this->auth::user();
        $user?->tokens()->delete();

        return true;
    }

    public function attempt($email, $password): bool
    {
        return $this->auth::attempt(['email' => $email, 'password' => $password]);
    }

    /**
     * @return User|false
     */
    public function attemptUser($email, $password): User|bool
    {
        return $this->attempt($email, $password)
            ? $this->repository->userByEmail($email)
            : false;
    }

    public function createToken(User $user): string
    {
        return $user->createToken('auth')->plainTextToken;
    }

    public function edit($id): ?User
    {
        return $this->repository->userById($id);
    }

    public function update($id, $name, $email, array $roleId): bool
    {
        return $this->repository->update($id, $name, $email, $roleId);
    }

    public function destroy($id): ?bool
    {
        return $this->repository->destroy($id);
    }

    public function permissionGroupsWithRoleName($request): mixed
    {
        return $request->user()
            ->getPermissionsViaRoles()
            ->groupBy('group_name')
            ->map(function ($permission) {
                return $permission->map(function ($permission) {
                    return $permission->only(['id', 'name']);
                });
            });
    }

    public function user($request): mixed
    {
        return $request->user()->only(['id', 'name', 'email']);
    }

    public function profileUpdate($name, $password): bool
    {
        return $this->repository->profileUpdate($name, $password);
    }
}
