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

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    protected $casts = [
        'product_id' => 'integer',
        'user_id' => 'integer',
        'active' => 'boolean',
    ];

    /**
     * @return void
     */
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param bool $applyOrder
     * @return \Illuminate\Database\Eloquent\Builder
     */
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
