<?php

namespace Domain\Shop\Models;

/**
 * @property string $key
 * @property string $name
 * @property string $css_color
 */
class OrderStatus extends Model
{
    public function getCssColorAttribute(): string
    {
        return match ($this->key) {
            ORDER_STATUS_CREATED => 'info',
            ORDER_STATUS_COMPLETED => 'success',
            ORDER_STATUS_CANCELED => 'danger',
            default => '',
        };
    }
}
