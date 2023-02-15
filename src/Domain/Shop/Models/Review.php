<?php

namespace Domain\Shop\Models;

use Illuminate\Database\Eloquent\Builder;
use Domain\Shop\Models\Traits\HasActiveState;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $product_id
 * @property integer $user_id
 * @property integer $rating
 * @property string $username
 * @property string $message
 *
 * @property \Domain\Shop\Models\Product $product
 * @property \Domain\Shop\Models\User $user
 */
class Review extends Model
{
    use HasActiveState;

    protected $guarded = [];

    protected $casts = [
        'product_id' => 'integer',
        'user_id' => 'integer',
        'active' => 'boolean',
    ];

    public static function boot(): void
    {
        parent::boot();

        static::created(function (Review $review): void {
            $review->product->recalculateRating();
        });

        static::updated(function (Review $review): void {
            $review->product->recalculateRating();
        });
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function scopeFilter(Builder $builder, bool $applyOrder = true): Builder
    {
        $builder->when(request('message'), function (Builder $builder): Builder {
            return $builder->where('message', 'LIKE', '%'.request()->get('message').'%');
        });

        $builder->when(request('product_id'), function (Builder $builder): Builder {
            return $builder->where('product_id', request('product_id'));
        });

        return parent::scopeFilter($builder, true);
    }
}
