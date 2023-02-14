<?php

namespace Domain\Shop\Repositories;

use Domain\Shop\Models\User;
use Domain\Shop\Requests\Account\PersonalSettingsRequest;
use Domain\Shop\Requests\Auth\RegisterRequest;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class UsersRepository
{
    /**
     * @param string $email
     * @return \Domain\Shop\Models\User|null
     */
    public function findByEmail(string $email): ?User
    {
        return User::query()->where('email', $email)->first();
    }

    /**
     * @param \Domain\Shop\Requests\Auth\RegisterRequest $request
     * @return \Domain\Shop\Models\User|null
     */
    public function register(RegisterRequest $request): ?User
    {
        return User::query()->create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'activated_at' => app()->environment('production') ? null : now(),
        ]);
    }

    /**
     * @param \Domain\Shop\Models\User $user
     * @param string $password
     * @return bool
     */
    public function updatePassword(User $user, string $password): bool
    {
        return $user->update([
            'password' => bcrypt($password),
        ]);
    }

    /**
     * @param \Domain\Shop\Models\User $user
     * @param \Domain\Shop\Requests\Account\PersonalSettingsRequest $request
     * @return bool
     */
    public function updatePersonalInformation(User $user, PersonalSettingsRequest $request): bool
    {
        return $user->update([
            'email' => $request->email,
            'phone' => $request->phone,
            'name' => $request->name,
        ]);
    }
}
