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

    /**
     * @var array
     */
    protected $guarded = ['old_new_password'];

    /**
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @var array
     */
    protected $casts = [
        'telegram_id' => 'integer',
        'role_id' => 'integer',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(ManagerRole::class, 'role_key', 'key');
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param bool $applyOrder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function scopeFilter(Builder $builder, bool $applyOrder = true): Builder
    {
        $builder->when(request('role_key'), function (Builder $builder): Builder {
            return $builder->where('role_key', request('role_key'));
        });

        return parent::scopeFilter($builder, $applyOrder);
    }


    /**
     * @return int
     */
    public function routeNotificationForTelegram(): int
    {
        return $this->telegram_id;
    }
}
