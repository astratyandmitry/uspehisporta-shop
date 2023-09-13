<?php

namespace Domain\Shop\Models;

use Domain\Shop\Models\Traits\HasActiveState;
use Domain\Shop\Models\Traits\HasSorting;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property string $image_desktop
 * @property string $image_mobile
 * @property string $url
 * @property bool $active
 */
class Banner extends Model
{
    use HasActiveState, HasSorting;

    protected $guarded = [];

    protected $casts = [
        'active' => 'boolean',
    ];

    public static function scopeFilter(Builder $builder, bool $applyOrder = true): Builder
    {
        return parent::scopeFilter($builder, false);
    }
}
