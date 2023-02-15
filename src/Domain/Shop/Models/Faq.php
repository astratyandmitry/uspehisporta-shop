<?php

namespace Domain\Shop\Models;

use Domain\Shop\Models\Traits\HasActiveState;
use Domain\Shop\Models\Traits\HasSorting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $position_key
 * @property string $title
 * @property string $image
 * @property string $image_mobile
 * @property string $url
 */
class Faq extends Model
{
    use HasActiveState, HasSorting;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
    ];

    public static function scopeFilter(Builder $builder, bool $applyOrder = true): Builder
    {
        $builder->when(request('info'), function (Builder $builder): Builder {
            return $builder
                ->where('name', 'LIKE', '%'.request()->get('info').'%')
                ->orWhere('about', 'LIKE', '%'.request()->get('info').'%');
        });

        return parent::scopeFilter($builder, false);
    }
}
