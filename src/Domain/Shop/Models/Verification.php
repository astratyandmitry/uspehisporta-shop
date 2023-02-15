<?php

namespace Domain\Shop\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\RedirectResponse;

/**
 * @property string $type_key
 * @property integer $user_id
 * @property string $code
 * @property \Carbon\Carbon $expired_at
 *
 * @property \Domain\Shop\Models\User $user
 * @property \Domain\Shop\Models\VerificationType $type
 */
class Verification extends Model
{
    protected $guarded = [
        'code',
        'expired_at',
    ];

    protected $casts = [
        'user_id' => 'integer',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'expired_at',
    ];

    public static function boot(): void
    {
        parent::boot();

        static::creating(function (Verification $verification): void {
            $verification->expired_at = now()->addHour();
            $verification->code = rand(100000, 999999);
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(VerificationType::class, 'type_key', 'key');
    }

    public function url(): string
    {
        return route('shop::auth.verification', [
            'email' => $this->user->email,
            'code' => $this->code,
        ]);
    }

    public function redirect(): RedirectResponse
    {
        return match ($this->type_key) {
            VERIFICATION_ACTIVATION => redirect()->route('shop::auth.login')
                ->with('message', 'Ваш код подтверждения успешно использован'),
            VERIFICATION_PASSWORD_RECOVERY => redirect()->route('shop::auth.password.reset', [
                'email' => $this->user->email,
                'code' => $this->code,
            ]),
            default => redirect()->route('shop::home'),
        };
    }

    public function handle(): void
    {
        switch ($this->type_key) {
            case VERIFICATION_ACTIVATION:
                $this->user->update(['activated_at' => now()]);
                break;
        }

        $this->delete();
    }

    public function custom(): bool
    {
        return in_array($this->type_key, [
            VERIFICATION_PASSWORD_RECOVERY,
        ]);
    }
}
