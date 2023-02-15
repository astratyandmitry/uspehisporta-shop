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
    protected $guarded = [];

    protected $casts = [
        'order_id' => 'integer',
        'product_id' => 'integer',
        'price' => 'integer',
        'count' => 'integer',
        'total' => 'integer',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function title(): string
    {
        return "{$this->product->name}";
    }
}
