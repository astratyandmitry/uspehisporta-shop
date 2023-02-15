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
    protected $fillable = [
        'client_name',
        'client_phone',
        'client_email',
        'delivery_address',
        'comment',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'delivery_price' => 'integer',
    ];

    public static function boot(): void
    {
        parent::boot();

        static::creating(function (Order $order): void {
            $order->uuid = Uuid::uuid1()->toString();
        });
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class, 'status_key', 'key');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

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

    public function changeStatus(string $status_key): void
    {
        $this->status_key = $status_key;
        $this->save();
    }

    public function current(): bool
    {
        return $this->status_key === ORDER_STATUS_CREATED;
    }

    public function url(): string
    {
        return route('shop::account.order', $this->id);
    }

    public function detailUrl(): string
    {
        return route('shop::order', [
            'id' => $this->id,
            'uuid' => $this->uuid,
        ]);
    }
}
