<?php

namespace Domain\Shop\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer|null $user_id
 * @property string|null $session_key
 * @property integer $product_id
 * @property string|null $variation
 * @property integer $count
 * @property integer $total
 *
 * @property \Domain\Shop\Models\Product $product
 */
class Basket extends Model
{
    use Compoships;

    protected $guarded = [
        'total',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'product_id' => 'integer',
        'count' => 'integer',
    ];

    protected $hidden = [
        'user_id',
        'session_key',
        'product_id',
        'created_at',
        'updated_at',
    ];

    protected $appends = ['total'];

    public function getTotalAttribute(): int
    {
        return $this->product->price() * $this->count;
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
