<?php

namespace App\Http\Controllers\User\Service;

use App\Helpers\DatatableHelper;
use App\Http\Controllers\User\Contract\UserInterface;
use App\Http\Controllers\User\Model\User;
use Exception;
use Illuminate\Support\Facades\Auth;

class UserService
{
    /**
     * @param UserInterface $repository
     * @param Auth $auth
     */
    public function __construct(public UserInterface $repository, public Auth $auth)
    {
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function index(): mixed
    {
        return DatatableHelper::datatable($this->repository->users(['id', 'name', 'email']));
    }

    /**
     * @param $email
     * @param $password
     * @return bool|string
     */
    public function authorization($email, $password): bool|string
    {
        $user = $this->attemptUser($email, $password);

        return $user ? $this->createToken($user) : false;
    }

    /**
     * @return bool
     */
    public function logout(): bool
    {
        $user = $this->auth::user();
        $user?->tokens()->delete();

        return true;
    }

    /**
     * @param $email
     * @param $password
     * @return bool
     */
    public function attempt($email, $password): bool
    {
        return $this->auth::attempt(['email' => $email, 'password' => $password]);
    }

    /**
     * @param $email
     * @param $password
     * @return User|false
     */
    public function attemptUser($email, $password): User|bool
    {
        return $this->attempt($email, $password)
            ? $this->repository->userByEmail($email)
            : false;
    }

    /**
     * @param User $user
     * @return string
     */
    public function createToken(User $user): string
    {
        return $user->createToken('auth')->plainTextToken;
    }

    /**
     * @param $id
     * @return User|null
     */
    public function edit($id): ?User
    {
        return $this->repository->userById($id);
    }

    /**
     * @param $id
     * @param $name
     * @param $email
     * @param array $roleId
     * @return bool
     */
    public function update($id, $name, $email, array $roleId): bool
    {
        return $this->repository->update($id, $name, $email, $roleId);
    }

    /**
     * @param $id
     * @return bool
     */
    public function destroy($id): bool
    {
        return $this->repository->destroy($id);
    }

    /**
     * @param $request
     * @return mixed
     */
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

    /**
     * @param $request
     * @return mixed
     */
    public function user($request): mixed
    {
        return $request->user()->only(['id', 'name', 'email']);
    }

    /**
     * @param $name
     * @param $password
     * @return bool
     */
    public function profileUpdate($name, $password): bool
    {
        return $this->repository->profileUpdate($name, $password);
    }
}
