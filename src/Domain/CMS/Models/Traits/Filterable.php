<?php

namespace Domain\CMS\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * @method static Builder filter()
 */
trait Filterable
{
    public static function scopeFilter(Builder $builder, bool $applyOrder = true): Builder
    {
        if ($applyOrder === true) {
            $builder->orderBy('id', 'desc');
        }

        $builder->when(request('id'), function (Builder $builder): Builder {
            return $builder->where('id', request('id'));
        });

        $builder->when(request('filter'), function (Builder $builder): Builder {
            switch (request('filter')) {
                case 'active':
                    $builder->where('active', true);
                    break;
                case 'not-active':
                    $builder->where('active', false);
                    break;
            }

            return $builder;
        });

        return $builder;
    }
}
