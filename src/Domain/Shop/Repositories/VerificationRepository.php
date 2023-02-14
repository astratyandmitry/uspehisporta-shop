<?php

namespace Domain\Shop\Repositories;

use Domain\Shop\Models\User;
use Domain\Shop\Models\Verification;
use Domain\Shop\Models\VerificationType;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class VerificationRepository
{
    /**
     * @param \Domain\Shop\Models\User $user
     * @param string $typeKey
     * @return \Domain\Shop\Models\Verification
     */
    public function generate(User $user, string $typeKey): Verification
    {
        return Verification::query()->create([
            'user_id' => $user->id,
            'type_key' => $typeKey,
        ]);
    }

    /**
     * @param \Domain\Shop\Models\User $user
     * @param string $typeKey
     * @return void
     */
    public function deletePrevious(User $user, string $typeKey): void
    {
        Verification::query()->where([
            'user_id' => $user->id,
            'type_key' => $typeKey,
        ])->delete();
    }

    /**
     * @param string $code
     * @return \Domain\Shop\Models\Verification|null
     */
    public function findByCode(string $code): ?Verification
    {
        return Verification::query()
            ->where('code', $code)
            ->where('expired_at', '>=', now())
            ->first();
    }

    /**
     * @param string $code
     * @return \Domain\Shop\Models\Verification|null
     */
    public function findPasswordRecoveryByCode(string $code): ?Verification
    {
        return Verification::query()
            ->where('type_key', VERIFICATION_PASSWORD_RECOVERY)
            ->where('code', $code)
            ->where('expired_at', '>=', now())
            ->first();
    }
}
