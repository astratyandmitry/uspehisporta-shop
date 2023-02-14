<?php

namespace Domain\Shop\Models;

use Illuminate\Support\Facades\Mail;
use Domain\Shop\Mails\VerificationMail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $phone
 * @property string $email
 * @property string $name
 * @property string $password
 * @property \Carbon\Carbon|null $activated_at
 *
 * @property \Domain\Shop\Models\Basket[] $baskets
 * @property \Domain\Shop\Models\Order[] $orders
 */
class User extends Model implements
    \Illuminate\Contracts\Auth\Authenticatable,
    \Illuminate\Contracts\Auth\Access\Authorizable
{
    use \Illuminate\Auth\Authenticatable,
        \Illuminate\Foundation\Auth\Access\Authorizable;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'activated_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function baskets(): HasMany
    {
        return $this->hasMany(Basket::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * @return bool
     */
    public function activated(): bool
    {
        return $this->activated_at !== null;
    }

    /**
     * @param \Domain\Shop\Models\Verification $verification
     */
    public function sendVerification(Verification $verification): void
    {
        if (app()->environment('production')) {
            Mail::to($this->email)->send(new VerificationMail($verification));
        }
    }
}
