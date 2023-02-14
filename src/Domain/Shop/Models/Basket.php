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

    /**
     * @var array
     */
    protected $guarded = [
        'total',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'product_id' => 'integer',
        'count' => 'integer',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'user_id',
        'session_key',
        'product_id',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $appends = ['total'];

    /**
     *
     * @return int
     */
    public function getTotalAttribute(): int
    {
        return $this->product->price() * $this->count;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
