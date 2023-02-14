<?php

namespace Domain\Shop\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ramsey\Uuid\Uuid;

/**
 * @property string $uuid
 * @property string $status_key
 * @property integer|null $user_id
 * @property string $client_name
 * @property string $client_phone
 * @property string $client_email
 * @property string $delivery_address
 * @property integer $delivery_price
 * @property integer $total
 * @property string|null $comment
 *
 * @property \Domain\Shop\Models\OrderStatus $status
 * @property \Domain\Shop\Models\User $user
 * @property \Domain\Shop\Models\OrderItem[] $items
 */
class Order extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'client_name',
        'client_phone',
        'client_email',
        'delivery_address',
        'comment',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'delivery_price' => 'integer',
    ];

    /**
     * @return void
     */
    public static function boot(): void
    {
        parent::boot();

        static::creating(function (Order $order): void {
            $order->uuid = Uuid::uuid1()->toString();
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class, 'status_key', 'key');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param bool $applyOrder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function scopeFilter(Builder $builder, bool $applyOrder = true): Builder
    {
        $builder->when(request('client'), function (Builder $builder): Builder {
            return $builder
                ->where('client_name', 'LIKE', '%'.request()->get('client').'%')
                ->orWhere('client_phone', 'LIKE', '%'.request()->get('client').'%')
                ->orWhere('client_email', 'LIKE', '%'.request()->get('client').'%');
        });

        $builder->when(request('status_key'), function (Builder $builder): Builder {
            return $builder->where('status_key', request('status_key'));
        });

        return parent::scopeFilter($builder);
    }

    /**
     * @param string $status_key
     * @return void
     */
    public function changeStatus(string $status_key): void
    {
        $this->status_key = $status_key;
        $this->save();
    }

    /**
     * @return bool
     */
    public function current(): bool
    {
        return $this->status_key === ORDER_STATUS_CREATED;
    }

    /**
     * @return string
     */
    public function url(): string
    {
        return route('shop::account.order', $this->id);
    }

    /**
     * @return string
     */
    public function detailUrl(): string
    {
        return route('shop::order', [
            'id' => $this->id,
            'uuid' => $this->uuid,
        ]);
    }
}
