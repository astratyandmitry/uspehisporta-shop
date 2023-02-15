<?php

namespace Domain\Shop\Repositories;

use Domain\Shop\Models\User;
use Domain\Shop\Models\Verification;
use Domain\Shop\Models\VerificationType;

class VerificationRepository
{
    public function generate(User $user, string $typeKey): Verification
    {
        return Verification::query()->create([
            'user_id' => $user->id,
            'type_key' => $typeKey,
        ]);
    }

    public function deletePrevious(User $user, string $typeKey): void
    {
        Verification::query()->where([
            'user_id' => $user->id,
            'type_key' => $typeKey,
        ])->delete();
    }

    public function findByCode(string $code): ?Verification
    {
        return Verification::query()
            ->where('code', $code)
            ->where('expired_at', '>=', now())
            ->first();
    }

    public function findPasswordRecoveryByCode(string $code): ?Verification
    {
        return Verification::query()
            ->where('type_key', VERIFICATION_PASSWORD_RECOVERY)
            ->where('code', $code)
            ->where('expired_at', '>=', now())
            ->first();
    }
}
