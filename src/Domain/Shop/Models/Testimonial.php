<?php

namespace Domain\Shop\Models;

use Domain\Shop\Models\Traits\HasActiveState;
use Domain\Shop\Models\Traits\HasSorting;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property string $author
 * @property string $message
 * @property string $url
 */
class Testimonial extends Model
{
    use HasSorting, HasActiveState;

    protected $guarded = [];

    public static function scopeFilter(Builder $builder, bool $applyOrder = true): Builder
    {
        $builder->when(request('info'), function (Builder $builder): Builder {
            return $builder
                ->where('author', 'LIKE', '%'.request()->get('info').'%')
                ->orWhere('message', 'LIKE', '%'.request()->get('info').'%');
        });

        return parent::scopeFilter($builder, $applyOrder);
    }
}
