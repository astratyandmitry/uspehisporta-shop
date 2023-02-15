<?php

namespace Domain\Shop\Repositories;

use Domain\Shop\Models\User;
use Domain\Shop\Requests\Account\PersonalSettingsRequest;
use Domain\Shop\Requests\Auth\RegisterRequest;

class UsersRepository
{
    public function findByEmail(string $email): ?User
    {
        return User::query()->where('email', $email)->first();
    }

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

    public function updatePassword(User $user, string $password): bool
    {
        return $user->update([
            'password' => bcrypt($password),
        ]);
    }

    public function updatePersonalInformation(User $user, PersonalSettingsRequest $request): bool
    {
        return $user->update([
            'email' => $request->email,
            'phone' => $request->phone,
            'name' => $request->name,
        ]);
    }
}
