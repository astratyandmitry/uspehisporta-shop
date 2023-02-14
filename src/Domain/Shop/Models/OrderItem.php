<?php

namespace Domain\Shop\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $order_id
 * @property integer $product_id
 * @property string|null $variation
 * @property integer $price
 * @property integer $count
 * @property integer $total
 *
 * @property \Domain\Shop\Models\Product $product
 */
class OrderItem extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    protected $casts = [
        'order_id' => 'integer',
        'product_id' => 'integer',
        'price' => 'integer',
        'count' => 'integer',
        'total' => 'integer',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return "{$this->product->name}";
    }
}
