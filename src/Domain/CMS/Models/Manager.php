<?php

namespace Domain\CMS\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

/**
 * @property integer $role_key
 * @property integer $telegram_id
 * @property string $email
 * @property string $password
 *
 * @property \Domain\CMS\Models\ManagerRole $role
 */
class Manager extends Model implements
    \Illuminate\Contracts\Auth\Authenticatable,
    \Illuminate\Contracts\Auth\Access\Authorizable
{
    use \Illuminate\Auth\Authenticatable,
        \Illuminate\Foundation\Auth\Access\Authorizable,
        Notifiable;

    protected $guarded = ['old_new_password'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'telegram_id' => 'integer',
        'role_id' => 'integer',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(ManagerRole::class, 'role_key', 'key');
    }

    public static function scopeFilter(Builder $builder, bool $applyOrder = true): Builder
    {
        $builder->when(request('role_key'), function (Builder $builder): Builder {
            return $builder->where('role_key', request('role_key'));
        });

        return parent::scopeFilter($builder, $applyOrder);
    }

    public function routeNotificationForTelegram(): int
    {
        return $this->telegram_id;
    }
}
