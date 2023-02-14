<?php

namespace Domain\Shop\Models;

/**
 * @property string $key
 * @property string $name
 * @property string $css_color
 */
class OrderStatus extends Model
{
    /**
     * @return string
     */
    public function getCssColorAttribute(): string
    {
        switch ($this->key) {
            case ORDER_STATUS_CREATED:
                return 'info';
                break;
            case ORDER_STATUS_COMPLETED:
                return 'success';
                break;
            case ORDER_STATUS_CANCELED:
                return 'danger';
                break;
            default:
                return '';
                break;
        }
    }
}
