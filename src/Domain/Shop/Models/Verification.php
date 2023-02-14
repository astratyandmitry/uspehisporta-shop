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
    /**
     * @var array
     */
    protected $guarded = [
        'code',
        'expired_at',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'expired_at',
    ];

    /**
     * @return void
     */
    public static function boot(): void
    {
        parent::boot();

        static::creating(function (Verification $verification): void {
            $verification->expired_at = now()->addHour();
            $verification->code = rand(100000, 999999);
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(VerificationType::class, 'type_key', 'key');
    }

    /**
     * @return string
     */
    public function url(): string
    {
        return route('shop::auth.verification', [
            'email' => $this->user->email,
            'code' => $this->code,
        ]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirect(): RedirectResponse
    {
        switch ($this->type_key) {
            case VERIFICATION_ACTIVATION:
                return redirect()->route('shop::auth.login')
                    ->with('message', 'Ваш код подтверждения успешно использован');
                break;
            case VERIFICATION_PASSWORD_RECOVERY:
                return redirect()->route('shop::auth.password.reset', [
                    'email' => $this->user->email,
                    'code' => $this->code,
                ]);
                break;
            default:
                return redirect()->route('shop::home');
        }
    }

    /**
     * @throws \Exception
     */
    public function handle(): void
    {
        switch ($this->type_key) {
            case VERIFICATION_ACTIVATION:
                $this->user->update(['activated_at' => now()]);
                break;
        }

        $this->delete();
    }

    /**
     * @return bool
     */
    public function custom(): bool
    {
        return in_array($this->type_key, [
            VERIFICATION_PASSWORD_RECOVERY,
        ]);
    }
}
